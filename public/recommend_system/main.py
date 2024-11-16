from fastapi import FastAPI, HTTPException, Request
from sqlalchemy import create_engine, text
from sqlalchemy.orm import Session
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import pandas as pd

#uvicorn main3:app --reload --port 8080

# Tạo ứng dụng FastAPI
app = FastAPI()

# Kết nối cơ sở dữ liệu MySQL
DATABASE_URL = "mysql+pymysql://root:@localhost/draft_datn"
engine = create_engine(DATABASE_URL)

# Hàm lấy tất cả sản phẩm từ cơ sở dữ liệu
def get_all_products():
    query = text("""
        SELECT 
            p.id AS product_id,
            p.name AS product_name,
            MAX(CASE WHEN a.id = 1 THEN av.value END) AS 'nong_do',
            MAX(CASE WHEN a.id = 2 THEN av.value END) AS 'phong_cach',
            MAX(CASE WHEN a.id = 3 THEN av.value END) AS 'nhom_huong',
            MAX(CASE WHEN a.id = 4 THEN av.value END) AS 'do_luu_huong',
            MAX(CASE WHEN a.id = 5 THEN av.value END) AS 'do_toa_huong',
            MAX(CASE WHEN a.id = 6 THEN av.value END) AS 'xuat_xu',
            MAX(CASE WHEN a.id = 7 THEN av.value END) AS 'thuong_hieu',
            MAX(CASE WHEN a.id = 8 THEN av.value END) AS 'nhom_tuoi'
        FROM 
            products p
        JOIN 
            Product_Attributes pa ON p.id = pa.product_id
        JOIN 
            Attribute_Values av ON pa.attribute_value_id = av.id
        JOIN 
            Attributes a ON av.attribute_id = a.id
        GROUP BY 
            p.id, p.name;
    """)

    # Thực hiện truy vấn và lấy kết quả
    with engine.connect() as connection:
        result = connection.execute(query).fetchall()
        return result

# Endpoint để gợi ý sản phẩm
@app.get("/recommend")
def recommend_product(product_id: int):
    try:
        # Lấy tất cả các sản phẩm
        products = get_all_products()
        if not products:
            raise HTTPException(status_code=404, detail="Không tìm thấy sản phẩm")

        # Chuyển kết quả thành DataFrame
        df = pd.DataFrame([{
            "product_id": row.product_id,
            "product_name": row.product_name,
            "combined_features": f"{row.nong_do} {row.phong_cach} "
                                 f"{row.nhom_huong} {row.do_luu_huong} {row.do_toa_huong} "
                                 f"{row.xuat_xu} {row.thuong_hieu} {row.nhom_tuoi}"
        } for row in products])

        # Nếu DataFrame rỗng
        if df.empty:
            raise HTTPException(status_code=404, detail="Không tìm thấy sản phẩm trong hệ thống")

        # Tạo ma trận TF-IDF
        tfidf = TfidfVectorizer()
        tfidf_matrix = tfidf.fit_transform(df['combined_features'])

        # Tìm sản phẩm theo product_id
        try:
            query_index = df[df['product_id'] == product_id].index[0]
        except IndexError:
            raise HTTPException(status_code=404, detail="Sản phẩm không tồn tại trong danh sách")

        # Tính toán độ tương đồng cosine
        query_vector = tfidf_matrix[query_index]
        cosine_sim = cosine_similarity(query_vector, tfidf_matrix).flatten()

        # Lấy ra 3 sản phẩm tương tự nhất (ngoại trừ chính nó)
        top_indices = cosine_sim.argsort()[-4:-1][::-1]

        # Chuẩn bị danh sách gợi ý
        recommendations = [
            {
                "product_id": int(df.iloc[i]['product_id']), 
                "product_name": df.iloc[i]['product_name'], 
                "similarity": round(cosine_sim[i], 2)}
            for i in top_indices
        ]

        # Trả về dữ liệu với code = 200
        return {"data": recommendations, "code": 200}

    except Exception as e:
        # Nếu có bất kỳ lỗi nào, trả về thông báo lỗi chi tiết
        return {"message": f"Lỗi từ server: {str(e)}", "code": 500}
