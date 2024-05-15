<?php

    namespace App\Entity;

    use \App\Db\Database;

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

    }