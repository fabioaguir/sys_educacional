<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\EventoRepository;
use SerEducacional\Entities\Evento;
use Illuminate\Support\Facades\Auth;

class EventoService
{
    use TraitService;

    /**
     * @var EventoRepository
     */
    private $repository;

    /**
     * @param EventoRepository $repository
     */
    public function __construct(EventoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Evento
     * @throws \Exception
     */
    public function store(array $data) : Evento
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        # Pegando o usuário autenticado
        $user = Auth::user();

        if ($user->tipo_usuario_id == 3) {
            $data['escola_id'] = \Session::get('escola')->id;
        }

        #Salvando o registro pincipal
        $evento =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$evento) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $evento;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Evento
     * @throws \Exception
     */
    public function update(array $data, int $id) : Evento
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $evento = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$evento) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $evento;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        #deletando o curso
        $result = $this->repository->delete($id);

        # Verificando se a execução foi bem sucessida
        if(!$result) {
            throw new \Exception('Ocorreu um erro ao tentar remover o curso!');
        }

        #retorno
        return true;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function find($id)
    {
        #Recuperando o registro no banco de dados
        $evento = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$evento) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $evento;
    }


}