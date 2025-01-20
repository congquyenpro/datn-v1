<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5>Thông tin giao hàng</h5>
                <hr>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Dài</label>
                            <input type="text" class="form-control" id="inputEmail4" value="30">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Rộng</label>
                            <input type="text" class="form-control" id="inputEmail4" value="10">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Cao</label>
                            <input type="text" class="form-control" id="inputEmail4" value="10">
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <label class="col-form-label col-sm-6 pt-0">Khối lượng</label>
                            <div class="col-sm-12 m-t-5">
                                <div class="radio">
                                    <input type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                    <label for="gridRadios1">
                                        Theo đơn hàng
                                    </label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                    <label for="gridRadios2">
                                        Mặc định
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="inputAddress">Khối lượng mặc định (Nếu có)</label>
                        <input type="text" class="form-control" id="inputAddress" value="600g">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState">Yêu cầu</label>
                            <select id="inputState" class="form-control">
                                <option selected>Cho xem hàng, cho thử</option>
                                <option>Cho xem hàng, không cho thử</option>
                                <option>Không cho xem hàng</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Ghi chú</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Thêm ghi chú cho shipper">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Lưu</button>
                </form>
            </div>
       </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5>Thông tin kho</h5>
                <hr>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Tên kho</label>
                            <input type="text" class="form-control" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Tỉnh/Thành phố</label>
                            <input type="text" class="form-control" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Quận/Huyện</label>
                            <input type="text" class="form-control" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Phường/Thị Xã</label>
                            <input type="text" class="form-control" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Chi tiết</label>
                            <input type="text" class="form-control" id="inputEmail4">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Lưu</button>
                </form>

                <div class="m-t-35">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kho hàng</th>
                                    <th>Địa chỉ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="sale-list">
                                <tr>
                                    <td>Kho Hà Nội</td>
                                    <td>Phường Trương Định, Quận Hai Bà Trưng, Hà Nội, 167</td>
                                    <td><div class="view-data modal-control" style="cursor: pointer" atr="Delete" data-id="3"><i class="anticon anticon-delete"></i></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
       </div>
    </div>
</div>