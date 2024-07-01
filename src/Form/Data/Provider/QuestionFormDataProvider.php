<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Form\Data\Provider;

use Ericc70\Expressopinionlite\Repository\QuestionRepository; 
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider\FormDataProviderInterface;

class QuestionFormDataProvider implements FormDataProviderInterface
{
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function getData($questionId)
    {
        $data_db = $this->questionRepository->find($questionId);
    
        if ($data_db !== null) {
            if ($data_db->getContent() !== null) {
                $data['content'] = $data_db->getContent();
            } else {
                $data['content'] = "";
            }
        } else {
            $data['content'] = "";
        }
    
        return $data;
    }
    public function getDefaultData(): array
    {
        return [
   
        ];
    }
}
