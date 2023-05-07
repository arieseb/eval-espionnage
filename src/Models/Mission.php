<?php

namespace App\Models;

use App\Exceptions\QueryException;

class Mission extends Database
{
    private ?int $id;
    private ?string $title;
    private ?string $codename;
    private ?string $description;
    private ?string $type;
    private ?\DateTimeInterface $startDate;
    private ?\DateTimeInterface $endDate;
    private ?int $country_id;
    private ?int $missionStatus_id;
    private ?int $requiredSpecialty_id;

    /**
     * @throws QueryException
     */
    protected function add(
        $codename,
        $title,
        $description,
        $type,
        $start_date,
        $end_date,
        $country_id,
        $specialty_id,
        $agent_id,
        $target_id,
        $contact_id
    )
    {
        $targetNationalityQuery = 'SELECT country_id FROM target WHERE id = :id';
        $targetNationalityParams = ['id' => $target_id];
        $targetNationality = $this->fetchData($targetNationalityQuery, $targetNationalityParams);

        $agentNationalityQuery = 'SELECT country_id FROM agent WHERE id = :id';
        $agentNationalityParams = ['id' => $agent_id];
        $agentNationality = $this->fetchData($agentNationalityQuery, $agentNationalityParams);

        $contactNationalityQuery = 'SELECT country_id FROM contact WHERE id = :id';
        $contactNationalityParams = ['id' => $contact_id];
        $contactNationality = $this->fetchData($contactNationalityQuery, $contactNationalityParams);

        $agentSpecialtyQuery = 'SELECT * FROM agent_specialty WHERE agent_id = :id';
        $agentSpecialtyParams = ['id' => $agent_id];
        $agentSpecialtyData = $this->fetchAllData($agentSpecialtyQuery, $agentSpecialtyParams);

        $specialtyCheck = false;
        foreach ($agentSpecialtyData as $agentSpecialty) {
            if (in_array($specialty_id, $agentSpecialty)) {
                $specialtyCheck = true;
            }
        }

        if ($targetNationality['country_id'] === $agentNationality['country_id']) {
            $message = "La cible ne peut pas être de la même nationalité que l'agent";
            throw new QueryException($message);
        }

        if ($contactNationality['country_id'] !== (int)$country_id) {
            $message = "Le contact ne peut pas être d'une nationalité différente que celle du pays de la mission";
            throw new QueryException($message);
        }

        if (!$specialtyCheck) {
            $message = "Le premier agent déployé sur la mission doit disposer de la spécialité requise";
            throw new QueryException($message);
        }

        $missionQuery = '
            INSERT INTO 
                mission 
                    (codename,
                    title,
                    description,
                    type,
                    start_date,
                    end_date,
                    country_id,
                    required_specialty,
                    mission_status_id)
            VALUES 
                (:codename,
                :title,
                :description,
                :type,
                :start_date,
                :end_date,
                :country_id,
                :required_specialty,
                :mission_status_id)
        ';
        $missionParams = [
            'codename' => $codename,
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'country_id' => $country_id,
            'required_specialty' => $specialty_id,
            'mission_status_id' => 1
        ];
        $mission_id = $this->queryLastInsertedId($missionQuery, $missionParams);

        $agentQuery = 'INSERT INTO mission_agent (agent_id, mission_id) VALUES (:agent_id, :mission_id)';
        $agentParams = ['agent_id' => $agent_id, 'mission_id' => $mission_id];
        $this->dbQuery($agentQuery, $agentParams);

        $contactQuery = 'INSERT INTO mission_contact (contact_id, mission_id) VALUES (:contact_id, :mission_id)';
        $contactParams = ['contact_id' => $contact_id, 'mission_id' => $mission_id];
        $this->dbQuery($contactQuery, $contactParams);

        $targetQuery = 'INSERT INTO mission_target (target_id, mission_id) VALUES (:target_id, :mission_id)';
        $targetParams = ['target_id' => $target_id, 'mission_id' => $mission_id];
        $this->dbQuery($targetQuery, $targetParams);

        header('location: mission-manage');
    }

    /**
     * @throws QueryException
     */
    public function readAll(): bool|array
    {
        $query = 'SELECT * FROM mission ORDER BY codename';
        $params = [];
        return $this->fetchAllData($query, $params);
    }

    /**
     * @throws QueryException
     */
    public function delete($id)
    {
        $query = 'DELETE FROM mission WHERE id = :id';
        $params = ['id' => $id];
        $this->dbQuery($query, $params);
        header('location: mission-manage');
    }

    /**
     * @throws QueryException
     */
    public function hideoutCountryCheck($mission_id, $hideout_id): bool
    {
        $hideoutQuery = 'SELECT country_id FROM hideout WHERE id = :id';
        $hideoutParams = ['id' => $hideout_id];
        $hideoutData = $this->fetchData($hideoutQuery, $hideoutParams);

        $missionQuery = 'SELECT * FROM mission WHERE id = :id';
        $missionParams = ['id' => $mission_id];
        $missionData = $this->fetchData($missionQuery, $missionParams);

        if ($hideoutData['country_id'] !== $missionData['country_id']) {
            $message = "La planque doit se situer dans le pays de la mission";
            throw new QueryException($message);
        }
        return true;
    }

    /**
     * @throws QueryException
     */
    public function addHideout($mission_id, $hideout_id)
    {
        $missionQuery = 'SELECT * FROM mission WHERE id = :id';
        $missionParams = ['id' => $mission_id];
        $missionData = $this->fetchData($missionQuery, $missionParams);

        if ($missionData['hideout_id'] !== null) {
            $message = "Impossible d'ajouter plus d'une planque à une mission";
            throw new QueryException($message);
        }

        if ($this->hideoutCountryCheck($mission_id, $hideout_id) === true) {
            $query = 'UPDATE mission SET hideout_id = :hideout_id WHERE id = :id';
            $params = ['id' => $mission_id, 'hideout_id' => $hideout_id];
            $this->dbQuery($query, $params);
            header('location: mission-manage');
        }
    }

    /**
     * @throws QueryException
     */
    public function addTarget($mission_id, $target_id)
    {
        $targetQuery = 'SELECT country_id FROM target WHERE id = :id';
        $targetParams = ['id' => $target_id];
        $targetData = $this->fetchData($targetQuery, $targetParams);

        $missionAgentQuery = 'SELECT agent_id FROM mission_agent WHERE mission_id = :mission_id';
        $missionAgentParams = ['mission_id' => $mission_id];
        $missionAgentData = $this->fetchAllData($missionAgentQuery, $missionAgentParams);

        $missionTargetQuery = 'SELECT * FROM mission_target WHERE mission_id = :mission_id';
        $missionTargetParams = ['mission_id' => $mission_id];
        $missionTargetData = $this->fetchAllData($missionTargetQuery, $missionTargetParams);

        foreach ($missionTargetData as $missionTarget) {
            if ($missionTarget['target_id'] === (int)$target_id && $missionTarget['mission_id'] === (int)$mission_id) {
                $message = "Cette cible est déjà visée par cette mission";
                throw new QueryException($message);
            }
        }

        foreach ($missionAgentData as $missionAgent) {
            $agentQuery = 'SELECT country_id FROM agent WHERE id = :id';
            $agentParams = ['id' => $missionAgent['agent_id']];
            $agentData = $this->fetchData($agentQuery, $agentParams);
            if ($targetData['country_id'] === $agentData['country_id']) {
                $message = "La cible ne peut pas être de la même nationalité que l'agent";
                throw new QueryException($message);
            }
        }

        $query = 'INSERT INTO mission_target (mission_id, target_id) VALUES (:mission_id, :target_id)';
        $params = ['mission_id' => $mission_id, 'target_id' => $target_id];
        $this->dbQuery($query, $params);

        header('location: mission-manage');
    }

    /**
     * @throws QueryException
     */
    public function addContact($mission_id, $contact_id)
    {
        $contactQuery = 'SELECT country_id FROM contact WHERE id = :id';
        $contactParams = ['id' => $contact_id];
        $contactData = $this->fetchData($contactQuery, $contactParams);

        $missionQuery = 'SELECT country_id FROM mission WHERE id = :id';
        $missionParams = ['id' => $mission_id];
        $missionData = $this->fetchData($missionQuery, $missionParams);

        $missionContactQuery = 'SELECT * FROM mission_contact WHERE mission_id = :mission_id';
        $missionContactParams = ['mission_id' => $mission_id];
        $missionContactData = $this->fetchAllData($missionContactQuery, $missionContactParams);

        foreach ($missionContactData as $missionContact) {
            if ($missionContact['contact_id'] === (int)$contact_id && $missionContact['mission_id'] === (int)$mission_id) {
                $message = "Ce contact est déjà sollicité pour cette mission";
                throw new QueryException($message);
            }
        }

        if ($contactData['country_id'] !== ($missionData['country_id'])) {
            $message = "Le contact ne peut pas être d'une nationalité différente que celle du pays de la mission";
            throw new QueryException($message);
        }

        $query = 'INSERT INTO mission_contact (mission_id, contact_id) VALUES (:mission_id, :contact_id)';
        $params = ['mission_id' => $mission_id, 'contact_id' => $contact_id];
        $this->dbQuery($query, $params);

        header('location: mission-manage');
    }

    /**
     * @throws QueryException
     */
    public function addAgent($mission_id, $agent_id)
    {
        $agentQuery = 'SELECT country_id FROM agent WHERE id = :id';
        $agentParams = ['id' => $agent_id];
        $agentData = $this->fetchData($agentQuery, $agentParams);

        $missionQuery = 'SELECT country_id FROM mission WHERE id = :id';
        $missionParams = ['id' => $mission_id];
        $missionData = $this->fetchData($missionQuery, $missionParams);

        $missionAgentQuery = 'SELECT * FROM mission_agent WHERE mission_id = :mission_id';
        $missionAgentParams = ['mission_id' => $mission_id];
        $missionAgentData = $this->fetchAllData($missionAgentQuery, $missionAgentParams);

        $missionTargetQuery = 'SELECT * FROM mission_target WHERE mission_id = :mission_id';
        $missionTargetParams = ['mission_id' => $mission_id];
        $missionTargetData = $this->fetchAllData($missionTargetQuery, $missionTargetParams);

        foreach ($missionAgentData as $missionAgent) {
            if ($missionAgent['agent_id'] === (int)$agent_id && $missionAgent['mission_id'] === (int)$mission_id) {
                $message = "Cet agent est déjà sollicité pour cette mission";
                throw new QueryException($message);
            }
        }

        foreach ($missionTargetData as $missionTarget) {
            $targetQuery = 'SELECT country_id FROM target WHERE id = :id';
            $targetParams = ['id' => $missionTarget['target_id']];
            $targetData = $this->fetchData($targetQuery, $targetParams);
            if ($agentData['country_id'] === $targetData['country_id']) {
                $message = "L'agent ne peut pas être de la même nationalité que la cible";
                throw new QueryException($message);
            }
        }

        $query = 'INSERT INTO mission_agent (mission_id, agent_id) VALUES (:mission_id, :agent_id)';
        $params = ['mission_id' => $mission_id, 'agent_id' => $agent_id];
        $this->dbQuery($query, $params);

        header('location: mission-manage');
    }

    /**
     * @throws QueryException
     */
    public function updateStatus($mission_id, $status_id)
    {
        $query = 'UPDATE mission SET mission_status_id = :status WHERE id = :id';
        $params = ['id' => $mission_id, 'status' => $status_id];
        $this->dbQuery($query, $params);
        header('location: mission-manage');
    }

    /**
     * @throws QueryException
     */
    public function updateHideout($mission_id, $hideout_id)
    {
        if ($this->hideoutCountryCheck($mission_id, $hideout_id) === true) {
            $query = 'UPDATE mission SET hideout_id = :hideout_id WHERE id = :id';
            $params = ['id' => $mission_id, 'hideout_id' => $hideout_id];
            $this->dbQuery($query, $params);
            header('location: mission-manage');
        }
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
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getCodename(): ?string
    {
        return $this->codename;
    }

    /**
     * @param string|null $codename
     */
    public function setCodename(?string $codename): void
    {
        $this->codename = $codename;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * @param \DateTimeInterface|null $startDate
     */
    public function setStartDate(?\DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * @param \DateTimeInterface|null $endDate
     */
    public function setEndDate(?\DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return int|null
     */
    public function getCountryId(): ?int
    {
        return $this->country_id;
    }

    /**
     * @param int|null $country_id
     */
    public function setCountryId(?int $country_id): void
    {
        $this->country_id = $country_id;
    }

    /**
     * @return int|null
     */
    public function getMissionStatusId(): ?int
    {
        return $this->missionStatus_id;
    }

    /**
     * @param int|null $missionStatus_id
     */
    public function setMissionStatusId(?int $missionStatus_id): void
    {
        $this->missionStatus_id = $missionStatus_id;
    }

    /**
     * @return int|null
     */
    public function getRequiredSpecialtyId(): ?int
    {
        return $this->requiredSpecialty_id;
    }

    /**
     * @param int|null $requiredSpecialty_id
     */
    public function setRequiredSpecialtyId(?int $requiredSpecialty_id): void
    {
        $this->requiredSpecialty_id = $requiredSpecialty_id;
    }

}