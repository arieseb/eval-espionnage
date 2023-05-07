<?php

namespace App\Models;

use App\Exceptions\QueryException;

class AgentSpecialty extends Database
{
    private ?int $id;
    private ?int $agent_id;
    private ?int $specialty_id;

    /**
     * @throws QueryException
     */
    public function getAgentSpecialty($agent_id): array
    {
        $query = 'SELECT * FROM agent_specialty WHERE agent_id = :agent_id';
        $params = ['agent_id' => $agent_id];
        return $this->fetchAllData($query, $params);
    }

    /**
     * @throws QueryException
     */
    protected function add($agent_id, $specialty_id)
    {
        foreach ($this->getAgentSpecialty($agent_id) as $agentSpecialityHaystack) {
            if ((int)$agent_id === $agentSpecialityHaystack['agent_id'] && (int)$specialty_id === $agentSpecialityHaystack['specialty_id']) {
                $message = 'Cet agent possède déjà cette spécialité';
                throw new QueryException($message);
            }
        }

        $query = 'INSERT INTO agent_specialty (agent_id, specialty_id) VALUES (:agent_id, :specialty_id)';
        $params = ['agent_id' => $agent_id, 'specialty_id' => $specialty_id];
        $this->dbQuery($query, $params);
        header('location: agent-manage');
    }

    /**
     * @throws QueryException
     */
    public function delete($agent_id, $specialty_id)
    {
        $verificationQuery = 'SELECT * FROM agent_specialty WHERE agent_id = :agent_id';
        $verificationParams = ['agent_id' => $agent_id];
        $verificationData = $this->fetchAllData($verificationQuery, $verificationParams);

        if(count($verificationData) === 1) {
            $message = 'Impossible de retirer la dernière spécialité de l\'agent';
            throw new QueryException($message);
        }

        $query = 'DELETE FROM agent_specialty WHERE agent_id = :agent_id AND specialty_id = :specialty_id';
        $params = ['agent_id' => $agent_id, 'specialty_id' => $specialty_id];
        $this->dbQuery($query, $params);
        header('location: agent-manage');
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getAgentId(): ?int
    {
        return $this->agent_id;
    }

    /**
     * @param int|null $agent_id
     */
    public function setAgentId(?int $agent_id): void
    {
        $this->agent_id = $agent_id;
    }

    /**
     * @return int|null
     */
    public function getSpecialtyId(): ?int
    {
        return $this->specialty_id;
    }

    /**
     * @param int|null $specialty_id
     */
    public function setSpecialtyId(?int $specialty_id): void
    {
        $this->specialty_id = $specialty_id;
    }

}