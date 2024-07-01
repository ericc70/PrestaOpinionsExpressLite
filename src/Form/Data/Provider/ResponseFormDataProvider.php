<?php
declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Form\Data\Provider;


use Ericc70\Expressopinionlite\Repository\ResponseRepository;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider\FormDataProviderInterface;


class ResponseFormDataProvider implements FormDataProviderInterface
{
    private $repository;

    public function __construct(ResponseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getData($questionId)
    {
        $data_db = $this->repository->find($questionId);

        if ($data_db !== null) {

            $data['content'] = $data_db->getContent();
            $data['question_id'] = $data_db->getQuestionId();
        } else {


            $data['content'] = "";
        }

        return $data;
    }
    public function getDefaultData(): array
    {
        return [];
    }
}
