<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Categoria;
use \PDO;

class CategoriaRepository
{
    public function __construct(
        private PDO $db
    ) {}

    /**
     * @return Categoria[]
     */
    public function getCategoria()
    {
        $categorias = $this->db->query("SELECT categorias.id, categorias.titulo FROM categorias ORDER BY titulo")->fetchAll();

        return array_map(fn(array $dados) => new Categoria(
            id: (int) $dados['id'],
            titulo: (string) $dados['titulo'],
        ), $categorias);
    }
}
