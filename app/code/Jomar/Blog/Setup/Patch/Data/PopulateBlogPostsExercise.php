<?php declare(strict_types=1);

namespace Jomar\Blog\Setup\Patch\Data;

use Jomar\Blog\Api\PostRepositoryInterface;
use Jomar\Blog\Model\PostFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class PopulateBlogPostsExercise implements DataPatchInterface
{

    private $postFactory;
    private $postRepository;
    private $moduleDataSetup;

    public function __construct(
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;

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
            'title' => 'Today is sunny',
            'content' => 'The weather has been great all week.'
        ]);
        $this->postRepository->save($post);

        $post2 = $this->postFactory->create();
        $post2->setData([
            'title' => 'Today is sunny',
            'content' => 'The weather has been great all week.'
        ]);
        $this->postRepository->save($post2);

        $this->moduleDataSetup->endSetup();
    }
}
