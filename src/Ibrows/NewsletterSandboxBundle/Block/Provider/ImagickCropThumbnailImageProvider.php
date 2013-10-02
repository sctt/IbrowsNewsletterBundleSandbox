<?php

namespace Ibrows\NewsletterSandboxBundle\Block\Provider;

use Ibrows\Bundle\NewsletterBundle\Block\Provider\ImageProvider;
use Ibrows\Bundle\NewsletterBundle\Model\Block\BlockInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImagickCropThumbnailImageProvider extends ImageProvider
{
    /**
     * @return array
     */
    public function getOptionKeys()
    {
        return array(
            'width' => array(
                'required' => true
            ),
            'height' => array(
                'required' => true
            )
        );
    }

    /**
     * @param BlockInterface $block
     * @param $update
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function updateBlock(BlockInterface $block, $update)
    {
        if(!$update instanceof UploadedFile){
            return false;
        }

        if(!$update->isValid()){
            return false;
        }

        $filename = md5($update->getFilename().uniqid());
        $block->setProviderOption(self::PROVIDER_OPTION_FILENAME, $filename);

        $image = new \Imagick();
        $image->readimage($update->getPathname());
        $image->cropthumbnailimage($block->getProviderOption('width'), $block->getProviderOption('height'));

        $image->writeimage($this->getFilePath($block));
    }
}