<?php

namespace Project;

use PDO;

class ProductRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(Product $product): bool
    {
        $stmt = $this->db->prepare("INSERT INTO products (name, description, price) VALUES (:name, :description, :price)");
        return $stmt->execute([
            ':name' => $product->getName(),
            ':description' => $product->getDescription(),
            ':price' => $product->getPrice()
        ]);
    }

    public function findById(int $id): ?Product
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch();

        if($data) {
            return new Product($data['name'], $data['description'], $data['price'], $data['id']);
        }
        return null;
    }

    public function findAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();

        $products = [];
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($results as $row) {
            $products[] = new Product($row['name'], $row['description'], $row['price'], $row['id']);
        }
        return $products;
    }

    public function update(Product $product): bool
    {
        if($product->getId() === null) {
            return false;
        }

        $stmt = $this->db->prepare("UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id");
        return $stmt->execute([
            ':name' => $product->getName(),
            ':description' => $product->getDescription(),
            ':price' => $product->getPrice(),
            ':id' => $product->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
