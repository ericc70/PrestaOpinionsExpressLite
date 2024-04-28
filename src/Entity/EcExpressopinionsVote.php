<?php

namespace Ericc70\Expressopinionlite\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ericc70\Expressopinionlite\Entity\EcExpressopinionsResponse;
use Ericc70\Expressopinionlite\Entity\EcExpressopinionsQuestion;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ericc70\Expressopinionlite\Repository\VoteRepository")
 * 
 */
class EcExpressopinionsVote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

   
   /**
     * @ORM\ManyToOne(targetEntity="EcExpressopinionsQuestion")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $questionId;

   /**
     * @ORM\ManyToOne(targetEntity="EcExpressopinionsResponse")
     * @ORM\JoinColumn(name="response_id", referencedColumnName="id")
     */
    private $responseId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    // Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionId(): ?EcExpressopinionsQuestion
    {
        return $this->questionId;
    }

    public function setQuestionId(?EcExpressopinionsQuestion $questionId): self
    {
        $this->questionId = $questionId;

        return $this;
    }
    public function __construct()
    {
        $this->responseId = new ArrayCollection();
      
    }
/**
     * Retourne uniquement les réponses associées à ce vote.
     *
     * @return Collection|EcExpressopinionsResponse[]
     */
    public function getResponseId(): Collection
    {
        return $this->responseId;
    }

    public function setResponseId( ?EcExpressopinionsResponse $responseId): self
    {
        $this->responseId = $responseId;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
