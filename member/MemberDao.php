<?php
    class MemberDao {
        private $db;                                //PDO 객체를 저장하기 위한 프로퍼티

        //Constructor Method
        public function __construct() {
            //~try~catch
            try {
                $this->db = new PDO("mysql:host=localhost;dbname=A1505033",
                    "A1505033", "1234");

                $this->db->setAttribute (
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                    );

            } catch (Exception $e) {
                exit($e->getMessage());
            }

        }

        //Select Information Method
        public function getMember($id) {        //정보 검색 메서드
            try {
                $query = $this->db->prepare("select * from member where id = :id");
                $query->bindValue(":id", $id, PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
            } catch(Exception $e) {
                exit($e->getMessage());
            }

            //결과값을 호출자에게 반환
            return $result;
        }

        //Insert Information Method
        public function insertMember($id, $pw, $name) {
            try {
               $query = $this->db->prepare("insert into member values(:id, :pw, :name)");
               $query->bindValue(":id", $id, PDO::PARAM_STR);
               $query->bindValue(":pw", $pw, PDO::PARAM_STR);
               $query->bindValue(":name", $name, PDO::PARAM_STR);

               $query->execute();
            } catch(Exception $e) {
                exit($e->getMessage());
            }
        }

        //update Information Method
        public function updateMember($id, $pw, $name) {
            try {
                $query = $this->db->prepare("update member set pw=:pw, name=:name where id =:id");
                $query->bindValue(":id", $id, PDO::PARAM_STR);
                $query->bindValue(":pw", $pw, PDO::PARAM_STR);
                $query->bindValue(":name", $name, PDO::PARAM_STR);

                $query->execute();

                //update member set pw = $pw, name = $name where id = $id
            } catch(Exception $e) {
                exit($e->getMessage());
            }
        }


    }