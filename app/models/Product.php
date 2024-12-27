<?php 

class Product extends  Database
{
    function all() {
        $sql=parent::$connection->prepare('SELECT`products`.*,`categories`.`name` AS categoriesName FROM `products` LEFT JOIN `categories` ON `products`.`category_id`=`categories`.`id` WHERE `products`.`status`=1');
       return parent::select($sql);
    }
    function allFind() {
        $sql=parent::$connection->prepare('SELECT `products`.*  FROM `products` LEFT JOIN `categories` ON `products`.`category_id`=`categories`.`id`');
       return parent::select($sql);
    }
    function find($id) {
        $sql=parent::$connection->prepare("SELECT `products`.*  FROM `products` LEFT JOIN `categories` ON `products`.`category_id`=`categories`.`id` WHERE `products`.`id`=?");
        $sql->bind_param("i",$id);
       return parent::select($sql)[0];
    }
    function findProductById($id) {
        $sql=parent::$connection->prepare("SELECT * FROM `products` LEFT JOIN `categories` ON `products`.`category_id`=`categories`.`id` WHERE `products`.`category_id`=?");
        $sql->bind_param("i",$id);
       return parent::select($sql);
    }
    public function findByKeyWord($keyword)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("SELECT * FROM `products` WHERE `name` LIKE ?");
        $keyword = "%{$keyword}%";
        $sql->bind_param('s', $keyword);
        // 3 & 4
        return parent::select($sql);
    }
    public function add($name, $price, $description, $image,$quantity, $category_id)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("INSERT INTO `products`(`name`, `price`, `description`, `image`,`quantity`,`category_id`) VALUES (?, ?, ?, ?,?,?)");
        $sql->bind_param('sissii', $name, $price, $description, $image,$quantity, $category_id);
        // 3 & 4
        $sql->execute();

      
       
        return $sql->execute();
    }
    public function allBin()
    {
        // 2. Tạo câu query
        // $sql = parent::$connection->prepare('SELECT * from `products`');
        $sql = parent::$connection->prepare('SELECT `products`.*
                                            FROM `products`
                                            WHERE `products`.`status`=0');
        // 3 & 4
        return parent::select($sql);
    }

    public function bin($productId)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("UPDATE `products` SET `status`=0 WHERE `id`=?");
        $sql->bind_param('i', $productId);
        // 3 & 4
        return $sql->execute();
    }
    public function restore($productId)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("UPDATE `products` SET `status`=1 WHERE `id`=?");
        $sql->bind_param('i', $productId);
        // 3 & 4
        return $sql->execute();
    }
    public function delete($productId)
    {
        // 2. Tạo câu query
        // Xóa categories cũ
      

        
        $sql = parent::$connection->prepare("DELETE FROM `products` WHERE `id`=?");
        $sql->bind_param('i', $productId);
        // 3 & 4
        return $sql->execute();
    }
    public function deleteAll($productIds)
    {
        // Tạo chuỗi kiểu ?,?,?
        $insertPlace = str_repeat("?,", count($productIds) - 1) . "?";
        // Tạo chuỗi iiiiiiii
        $insertType = str_repeat('i', count($productIds));


        // 2. Tạo câu query
        // Xóa categories cũ
   
        
        $sql = parent::$connection->prepare("DELETE FROM `products` WHERE `id` IN ($insertPlace)");
        $sql->bind_param($insertType, ...$productIds);

        // 3 & 4
        return $sql->execute();
    }
    public function update($name, $price, $description, $image, $quantity, $category_id,$productId)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("UPDATE `products` SET `name`=?,`price`=?,`description`=?,`image`=?,`quantity`=?,`category_id`=? WHERE `id`=?");
        $sql->bind_param('sissiii', $name, $price, $description, $image,$quantity, $category_id, $productId);
        // 3 & 4
   


        // Xóa categories cũ
 


        // Thêm categories mới
        // 2. Tạo câu query
 
        // Tạo chuỗi kiểu (?, id), (?, id), (?, id)
      

    
        return $sql->execute();
    }
}
