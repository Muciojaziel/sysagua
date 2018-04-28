<?php
    class Conexao{
        private $host1;
        private $usuario;
        private $senha;
        private $banco;
        private $conexao;
        
        public function __construct($host, $usuario, $senha, $banco)
        {
            $this->host1 = $host;
            $this->usuario = $usuario;
            $this->senha = $senha;
            $this->banco = $banco;
        }
        
        public function conectar()
        {
            $this->conexao = mysqli_connect(
            $this->host1,
            $this->usuario,
            $this->senha,
            $this->banco
             );
            if(mysqli_connect_errno($this->conexao))
                {
                return false;
            }
            else
                {
                mysqli_query($this->conexao, "SET NAMES 'utf8';");
                return true;
            }
        }
        public function executarQuery($sql)
        {
            return mysqli_query($this->conexao, $sql);
        }
    public function obtemPrimeiroRegistroQuery($query)
        {           
        $linhas = $this->executarQuery($query);
        return mysqli_fetch_array($linhas);
        
        }
    }
        
?>