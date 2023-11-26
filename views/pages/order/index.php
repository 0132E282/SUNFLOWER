<div class="container-xxl flex-grow-1 container-p-y">
    <div class="w-100">
    </div>
    <div class="card">
        <h5 class="card-header">quẩn lý đơn hàng</h5>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>mã đơn hàng</th>
                    <th>tên khách hàng</th>
                    <th>số điện thoại</th>
                    <th>số tiền thánh toán</th>
                    <th>thành phố</th>
                    <th>ngày tạo</th>
                    <th>trạng thái</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (isset($orderList) && count($orderList) > 0) : ?>
                    <?php foreach ($orderList as $key => $order) : ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td></td>
                            <td><a href="?controller=order&action=detail&id=<?= $order['id'] ?>"><?= $order['customer_name'] ?></a></td>
                            <td><?= $order['customer_phone_number'] ?></td>
                            <td><?= $order['total'] ?></td>
                            <td><?= $order['customer_city'] ?></td>
                            <td><?= $order['created_at'] ?></td>
                            <td><?= $order['status'] == 2 ? 'đã giao hàng'  : ($order['status'] == 1 ? 'đã xử lý' : 'chưa xử lý') ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr colspan="8">
                        <td>không có dữ liệu</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>