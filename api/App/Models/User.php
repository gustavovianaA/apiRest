<?php

namespace App\Models;

class User
{
    private static $table = 'user';

    private $conn;

    public function __construct()
    {
        $this->conn = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
    }

    public function select(int $id)
    {
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public function selectALL()
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'SELECT * FROM ' . self::$table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public function insert($data)
    {
        $sql = 'INSERT INTO ' . self::$table . ' (email,password,name) VALUES (:email,:password,:name)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':password', $data['password']);
        $stmt->bindValue(':name', $data['name']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Usuário(a) inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir usuário(a)");
        }
    }

    public function update($data)
    {
        $sql = 'UPDATE ' . self::$table . ' SET email = :email, password = :password, name = :name WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $data['id']);
        
        if(empty($data['email']))
            str_replace('email = :email,','',$sql);
        else
            $stmt->bindValue(':email', $data['email']);
        //todo
        $stmt->bindValue(':password', $data['password']);
        $stmt->bindValue(':name', $data['name']);
 
        if ($stmt->execute()) {
            return 'Usuário(a) alterado com sucesso!';
        } else {
            throw new \Exception("Falha ao atualizar usuário(a)");
        }
    }

    public static function delete($data){
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
            $sql = 'DELETE FROM ' . self::$table . ' WHERE id=:id;';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id',$data['id']);
            $stmt->execute();
            $teste = '';
            foreach($data as $d){
                 $teste .= $d;
            }

            if($stmt->rowCount() > 0){
                return 'Usuário(a) deletado com sucesso!';
            }else{
                return $teste;
                throw new \Exception("Falha ao deletar usuário(a)");
            }
        }
}
