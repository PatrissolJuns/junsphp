<?php
    class Model
    {
        public function findModel($model, $id)
        {
            $sql = "SELECT * FROM ".$model." WHERE id =" . $id;
            $req = Model::data($sql, "SELECT");
            return $req->fetch();
        }
        public function findModelAll($model)
        {
            $sql = "SELECT * FROM ".$model;
            $req = Model::data($sql, "SELECT");
            return $req->fetchAll();
        }
        public function saveModel($model, $params, $values)
        {
            $str1 = ''; $str2 = '';
            foreach($params as $paramsItem){
                $str1 .= ''.$paramsItem.', ';
            } 
            $str1 = substr($str1, 0, -2);
            foreach($values as $valuesItem){
                $str2 .= "'".$valuesItem."', ";
            } 
            $str2 = substr($str2, 0, -2);

            $sql = "INSERT INTO ".$model." (".$str1.") VALUES (".$str2.")";
            
            $result = Database::getDatabase()->exec($sql);
            if(!$result)
            {
                throw new Exception("Error while saving data", 519);
            }

            return $result;
        }
        
        private static function data($sql, $mode)
        {
            if($mode == "SELECT")
            {
                $req = Database::getDatabase()->prepare($sql);
                $req->execute();
                return $req;
            }
            else if ($mode == "INSERT" || $mode == "UPDATE" || $mode == "DELETE")
            {
                $req = Database::getDatabase()->prepare($sql);
                return $req;
            }
            else
            {
                throw new Exception("The method is incorrect", 1);
            }
        }
    }
