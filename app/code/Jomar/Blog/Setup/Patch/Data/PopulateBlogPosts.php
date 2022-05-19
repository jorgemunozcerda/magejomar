<?php declare(strict_types=1);

namespace Jomar\Blog\Setup\Patch\Data;

use Jomar\Blog\Api\PostRepositoryInterface;
use Jomar\Blog\Model\PostFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class PopulateBlogPosts implements DataPatchInterface
{

    private $moduleDataSetup;
    private $postFactory;
    private $postRepository;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
        $this->moduleDataSetup = $moduleDataSetup;

    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $post = $this->postFactory->create();
        $post->setData([
            'title' => 'An awesome post',
            'content' => 'This post content is really awesome'
        ]);
        $this->postRepository->save($post);

        $this->moduleDataSetup->endSetup();
    }
}
