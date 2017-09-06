<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\PermissionRepository;
use SerEducacional\Repositories\RoleRepository;
use SerEducacional\Entities\Role;

class RoleService
{
    use TraitService;
    
    /**
     * @var RoleRepository
     *
     */
    private $repository;

    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * @param RoleRepository $repository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $repository, PermissionRepository $permissionRepository)
    {
        $this->repository           = $repository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function find($id)
    {
        #Recuperando o registro no banco de dados
        $role = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$role) {
            throw new \Exception('Perfil não encontrada!');
        }

        #retorno
        return $role;
    }

    /**
     * @param array $data
     * @return Role
     * @throws \Exception
     */
    public function store(array $data) : Role
    {
        #tratando o slug
        $data['slug']    = $data['name'];
        $data['sistema'] = 1;

        #Salvando o registro pincipal
        $role =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$role) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Recupernado as permissions
        $permissions = $data['permission'] ?? [];

        #Tratando as permissões
        foreach ($permissions as $permission) {
            #Recuperando os papéis
            $permissionObj = $this->permissionRepository->find($permission);

            #Verificando se o registro foi recuperado
            if(!$permissionObj) {
                throw new \Exception('Ocorreu um erro ao cadastrar as permissões!');
            }

            #Vinculando ao role
            $role->attachPermission($permissionObj);
        }

        #Retorno
        return $role;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Role
     * @throws \Exception
     */
    public function update(array $data, int $id) : Role
    {
        #tratando o slug
        $data['slug'] = $data['name'];

        #Atualizando no banco de dados
        $role = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$role) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #deletando as permissions
        $role->detachAllPermissions();

        #Recupernado as permissions
        $permissions = $data['permission'] ?? [];

        #Tratando as permissões
        foreach ($permissions as $permission) {
            #Recuperando os papéis
            $permissionObj = $this->permissionRepository->find($permission);

            #Verificando se o registro foi recuperado
            if(!$permissionObj) {
                throw new \Exception('Ocorreu um erro ao cadastrar as permissões!');
            }

            #Vinculando ao role
            $role->attachPermission($permissionObj);
        }

        #Retorno
        return $role;
    }
}