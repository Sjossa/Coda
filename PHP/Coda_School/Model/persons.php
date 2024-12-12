<?php
    function getAllPersons(PDO $pdo, string | null $search = null, string | null $sortby = null)
    {
        $query = 'SELECT * FROM persons';
       if (null !== $search) {
           $query .= ' WHERE id LIKE :search OR last_name LIKE :search OR first_name LIKE :search OR address LIKE :search OR type LIKE :search';
       }

       if (null !== $sortby) {
           $query .= " ORDER BY $sortby";
       }
        $statement = $pdo->prepare($query);

        try {
           if (null !== $search) {
               $statement->bindValue(':search', "%$search%");
           }


            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

    }
