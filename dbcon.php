<?php
class dbcon extends PDO
{
    public function __construct()
    {
        try{
            parent::__construct(DSN, USER, PASS
            );

        }catch (PDOException $excp){
            die("No se pude realizar la conexión" . $excp->getMessage());
        }
    }
    private function generar_consulta(string $sentencia, array $parametros = []){
        $stmnt = $this->prepare($sentencia);
        $stmnt->setFetchMode(PDO::FETCH_ASSOC);
        $stmnt->execute($parametros);
        return $stmnt;
    }
    public function validar_usuario(string $user, string $pass) {
        $parametros = [$user, $pass];
        $sentencia = "SELECT * FROM usuarios WHERE nombre = ? AND pass = ?;";
        $log = $this->generar_consulta($sentencia, $parametros);
        $salida = (bool)$log->fetch();
        var_dump($salida);
        return $salida;
    }
    public function muestra_familias(){
        $sentencia = "SELECT nombre, cod FROM familia";
        $familias = $this->generar_consulta($sentencia);
        $salida = [];
        while($row = $familias->fetch()){
            $salida [] = $row['nombre'];
            $salida [] = $row['cod'];
        }
        return $salida;
    }
    public function muestra_productos(string $familia){
        $parametros = [$familia];
        $sentencia = "SELECT nombre_corto, PVP FROM producto WHERE familia = ?";
        $productos = $this->generar_consulta($sentencia, $parametros);
        $indice = 0;
        while($row = $productos->fetch()){
            $salida [$indice][] = $row['nombre_corto'];
            $salida [$indice][] = $row['PVP'];
            $indice++;
        }
        return $salida;
    }
    public function codigo_familia(string $familia){
        $parametros = [$familia];
        $sentencia = "SELECT cod FROM familia WHERE nombre = ?";
        $productos = $this->generar_consulta($sentencia, $parametros);
        while($row = $productos->fetch()){
            $salida = $row['cod'];
        }
        return $salida;
    }
}