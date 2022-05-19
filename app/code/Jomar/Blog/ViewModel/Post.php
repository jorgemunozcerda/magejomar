<?php declare(strict_types=1);

namespace Jomar\Blog\ViewModel;

use Jomar\Blog\Api\Data\PostInterface;
use Jomar\Blog\Api\PostRepositoryInterface;
use Jomar\Blog\Model\ResourceModel\Post\Collection;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Post implements ArgumentInterface
{
    private $collection;
    private $postRepository;
    private $request;

    public function __construct(
        Collection $collection,
        PostRepositoryInterface $postRepository,
        RequestInterface $request
    ) {
        $this->request = $request;
        $this->postRepository = $postRepository;
        $this->collection = $collection;
    }

    public function getList(): array
    {
        return $this->collection->getItems();
    }

    public function getCount(): int
    {
        return $this->collection->count();
    }

    public function getDetail(): PostInterface
    {
        $id = (int) $this->request->getParam('id');
        return $this->postRepository->getById($id);
    }
}
