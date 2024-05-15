<?php

    /* Essa classe vai fazer ponte entre sistema e db utilizando DBO
        O QUERY BUILDER não escreve SQL mas consegue executar as mesmas funções
    */

    namespace App\Db;

    use \PDO; // Já define como uma dependência
    use PDOException;

    class Database{

        const HOST = 'localhost';
        const NAME = 'wdev_vagas';
        const USER = 'root';
        const PASS = '';

        /**
         * Nome da tabela a ser manipulada
         *
         * @var [type]
         */
        private $table;


        /**
         * Instãncia de PDO
         *
         * @var PDO
         */
        private $connection;

        /**
         * Define a tabela e instancia a conexão
         *
         * @param string $table
         */
        public function __construct($table = null){
            $this->table = $table;
            $this->setConnection();
        }

        /**
         * Método responsável por criar conexão com o banco de dados
         *
         * @return void
         */
        private function setConnection(){
            try {
                                        // String de conexão, Usuário do banco, Senha do banco
                $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
                // Sempre que houver algum erro em uma query, seja de sintaxe ou campo, ele retorna uma exception e trave o sistema
                                        // Atributo que queremos alterar, valor que o atributo vai receber
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }


        /**
         * Metodo responsável por executar querys dentro do banco de dados
         *
         * @param string $query
         * @param array $params
         * @return PDOStatement
         */
        public function execute($query, $params = []){
            try {
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                
                return $statement;
                
            } catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }


        /**
         * Metodo responsável por inserir os dados no banco
         *
         * @param array $values [ field => value]
         * @return integer ID inserido
         */
        public function insert($values){
            // DADOS DA QUERY
            $fields = array_keys($values); // Pega os índices de um array;
            // Posso pegar um array, esse array precisa ter X posições, se não tiver, você irá criá-las com um padrão específico
            $binds  = array_pad([], count($fields), '?');


            // MONTA A QUERY
                                        // implode(separador, array)
            $query = "INSERT INTO ".$this->table." (".implode(',', $fields).") VALUES (".implode(',', $binds).")";
            
            // Executa o INSERT
                                    // passa apenas os valores
            $this->execute($query, array_values($values));

            // Retorna o ID inserido
            return $this->connection->lastInsertId();
        }

    }