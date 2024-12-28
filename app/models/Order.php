
<?php
class Order extends Database
{
    function all()
    {
        $sql = parent::$connection->prepare("SELECT * FROM `orders` ORDER BY (`orders`.`created_at`) DESC");

        return parent::select($sql);
    }
    function findByIDs($id)
    {
        $sql = parent::$connection->prepare('SELECT * FROM `orders` WHERE `id` = ? ');
        $sql->bind_param("i", $id);
        return parent::select($sql);
    }
   
    function updateStatus($status, $id)
    {
        $sql = parent::$connection->prepare("UPDATE `orders` SET `status`=? WHERE `id`=?");
        $sql->bind_param("ii", $status, $id);
        return $sql->execute();
    }
    function getOrderDetails($id)
    {
        $sql = parent::$connection->prepare("SELECT *,`products`.`name` AS 'productName',`users`.`username` AS 'userName',`users`.`address` AS 'address',`users`.`phone`
                                            FROM `orderdetail` JOIN `products` ON `orderdetail`.`productId`=`products`.`id`
                                            JOIN `orders` ON `orders`.`id`=`orderdetail`.`orderId`
                                            JOIN `users` ON `users`.`id`=`orders`.`userId`
                                            WHERE `orderId`=?");
        $sql->bind_param("i", $id);
        return parent::select($sql);
    }



    function getTotalProducts()
    {
        $sql = parent::$connection->prepare("
        SELECT SUM(orderdetail.quantity) AS totalProducts 
        FROM orderdetail
    ");
        // $sql->execute();
        return parent::select($sql)[0]['totalProducts'];
    }
    function getTotalOrders()
    {
        $sql = parent::$connection->prepare("SELECT COUNT(`id`) AS 'total' FROM `orders`");

        return parent::select($sql)[0]['total'];
    }
    function getTotalRevenue()
    {
        $sql = parent::$connection->prepare("SELECT SUM(`totalAmount`) AS 'total' FROM `orders`");

        return parent::select($sql)[0]['total'];
    }

    function getTopProducts()
    {
        $sql = parent::$connection->prepare("SELECT 
    subquery.total AS max,
    subquery.idps,
    products.*
FROM (
    SELECT 
        SUM(orderdetail.quantity) AS total, 
        orderdetail.productId AS idps
    FROM 
        orderdetail
    GROUP BY 
        orderdetail.productId
) AS subquery
JOIN 
    products 
ON 
    subquery.idps = products.id
ORDER BY 
    subquery.total DESC
LIMIT 1;
    ");

        return parent::select($sql)[0];
    }


    function getMonthlyRevenue()
    {
        $sql = parent::$connection->prepare("SELECT DATE_FORMAT(`created_at`, '%Y-%m') AS `month`,
                                                            SUM(`totalAmount`) AS `monthlyRevenue`
                                            FROM `orders`
                                            GROUP BY  DATE_FORMAT(`created_at`, '%Y-%m')
                                            ORDER BY  `month` ASC;
                                            ");

        return parent::select($sql);
    }

    function getTopProductsMonth()
    {
        $sql = parent::$connection->prepare("SELECT SUM(`orderdetail`.`quantity`) AS total,`products`.`name`
                                                FROM `orderdetail`                     
                                            JOIN `products` ON `orderdetail`.`productId`=`products`.`id`
                                                    GROUP BY `productId`");

        return parent::select($sql);
    }

    function getMonthlyProductStatistics()
    {
        $sql = parent::$connection->prepare("
        SELECT 
            MONTH(orders.created_at) AS month,
            SUM(orderdetail.quantity) AS total,
            products.name AS name
        FROM 
            orderdetail
        JOIN 
            products 
        ON 
            orderdetail.productId = products.id
         JOIN 
            orders
        ON 
            orderdetail.orderId= orders.id
           
        GROUP BY 
            products.id, MONTH(orders.created_at)
        ORDER BY 
            month ASC
    ");

        return parent::select($sql);
    }

  public function getMonthlyYearProductStatistics($month, $year){
    $sql = parent::$connection->prepare("
        SELECT 
            SUM(orderdetail.quantity) AS total,
            products.name AS productName
        FROM 
            orderdetail
        JOIN 
            products 
        ON 
            orderdetail.productId = products.id
        JOIN 
            orders
        ON 
            orderdetail.orderId = orders.id
        WHERE 
            MONTH(orders.created_at) = ? 
            AND YEAR(orders.created_at) = ?
        GROUP BY 
            products.id
        ORDER BY 
            total DESC
    ");
    $sql->bind_param("ii", $month, $year);
    return parent::select($sql);
}




    // function all() {
    //     $sql=parent::$connection->prepare('SELECT * FROM `categories`');
    //    return parent::select($sql);
    // }

    function findByUserID($id)
    {
        $sql = parent::$connection->prepare('SELECT * FROM `orders` WHERE `userId` = ? and `status` != 0 ORDER BY `id` DESC');
        $sql->bind_param("i", $id);
        return parent::select($sql);
    }

    function findByID($id)
    {
        $sql = parent::$connection->prepare('SELECT * FROM `orders` WHERE `id` = ? ');
        $sql->bind_param("i", $id);
        return parent::select($sql)[0];
    }

    function findAllByUserID($id)
    {
        $sql = parent::$connection->prepare('SELECT * FROM `orders` WHERE `userId` = ? ORDER BY `id` DESC');
        $sql->bind_param("i", $id);
        return parent::select($sql);
    }

    function saveOrder($paymentMethod, $status, $totalAmount, $userId)
    {
        $sql = parent::$connection->prepare('INSERT INTO `orders`(`paymentMethod`, `status`,`totalAmount`, `userId`) VALUES (?, ?, ?, ?)');

        $sql->bind_param('siii', $paymentMethod, $status, $totalAmount, $userId);

        // 3 & 4
        $sql->execute();
        $last_id = parent::$connection->insert_id;
        $sql = parent::$connection->prepare('SELECT * FROM `orders` WHERE `id` = ?');
        $sql->bind_param("i", $last_id);
        return parent::select($sql)[0];
    }
    public function deleteOrder($orderId)
    {

        $sql = parent::$connection->prepare("UPDATE `orders` SET `status`= 0 WHERE `id`=?");
        $sql->bind_param('i', $orderId);
        // 3 & 4
        $sql->execute();

        $sql = parent::$connection->prepare("UPDATE `orderdetail` SET `status`= 0 WHERE `orderId`=?");
        $sql->bind_param('i', $orderId);
        return $sql->execute();
    }

    public function restoreOrder($orderId)
    {

        $sql = parent::$connection->prepare("UPDATE `orders` SET `status`= 1 WHERE `id`=?");
        $sql->bind_param('i', $orderId);
        // 3 & 4
        $sql->execute();

        $sql = parent::$connection->prepare("UPDATE `orderdetail` SET `status`= 1 WHERE `orderId`=?");
        $sql->bind_param('i', $orderId);
        return $sql->execute();
    }

    public function delete($orderId)
    {

        $sql = parent::$connection->prepare("DELETE FROM `orders` WHERE `id`=?");
        $sql->bind_param('i', $orderId);
        // 3 & 4
        $sql->execute();

        $sql = parent::$connection->prepare("DELETE FROM `orderdetail` WHERE `orderId`=?");
        $sql->bind_param('i', $orderId);
        return $sql->execute();
    }
}
