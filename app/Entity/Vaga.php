<?php

    namespace App\Entity;

    use \App\Db\Database;
    use \PDO;

    class Vaga{

        /**
        *   Identificador único da vaga
        *    @var integer,
        */
        public $id;


        /**
         * Título da vaga
         * @var string
         */
        public $titulo;

        /**
         * Descrição da vaga da vaga
         * @var string
         */
        public $descricao;


        /**
         * Verifica se a vaga está ativa ou não
         * @var string(S/N)
         */
        public $ativo;


        /**
         * Data de publicação da vaga
         * @var string
         */

         public $data;


         /**
          * Método responsável por cadastrar a nova vaga no banco
          *
          * @return boolean
          */
         public function cadastrar(){
            // DEFINIR A DATA
            $this->data = date('Y-m-d H:i:s');

            // INSERIR A VAGA NO BANCO
            $obDatabase = new Database('vagas');
            
            // Se der sucesso, ele retornará o id como sucesso
            $this->id = $obDatabase->insert([
                'titulo'    => $this->titulo,
                'descricao' => $this->descricao,
                'ativo'     => $this->ativo,
                'data'      => $this->data
            ]);

            

            // ATRIBUIR O ID DA VAGA NA INSTÂNCIA
            return true;

            // RETORNAR SUCESSO
         }


         /**
          * Método rsponsável por atualizar a vaga no banco
          *
          * @return boolean
          */
         public function atualizar(){
            return (new Database('vagas'))->update('id = '.$this->id, [
                'titulo'    => $this->titulo,
                'descricao' => $this->descricao,
                'ativo'     => $this->ativo,
                'data'      => $this->data
            ]);
         }

         /**
          * Método responsável por excluir a vaga do banco
          *
          * @return boolean
          */
         public function excluir(){
            return (new Database('vagas'))->delete('id = '.$this->id);
         }




         /**
          * Pq que ele me retorna um método estático, pq ele vai me retornar várias instâncias de vagas
          * Método responsável por obter as vagas do banco de dados
          *
          * @param string $where
          * @param string $order
          * @param string $limit
          * @return array
          */
         public static function getVagas($where = null, $order = null, $limit = null){
            return (new Database('vagas'))->select($where, $order, $limit)
                                        ->fetchAll(PDO::FETCH_CLASS, self::class);
                                        // PDO tem um método chamado fetchAll() -> todo retorno vai ser transformado em um array. 
                                        // dentro do PDO tem umas constante que nos ajudam e uma delas é o FETCH_CLASS que define o tipo de array que será retornado
                                        // no caso é o tipo de classe de objetos
                                        // o objeto será um tipo de instância da própria classe
         }

         /**
          * Método rsponsável por buscar uma vaga com base em seu id
          *
          * @param integer $id
          * @return Vaga
          */
         public static function getVaga($id){
            return (new Database('vagas'))->select('id = '.$id)
                                          ->fetchObject(self::class);
                                          //FETCH UNITÁRIO - PEGA APENAS UMA POSIÇÃO

         }

    }