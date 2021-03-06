<?php
/**
 * Upload media content to server
 *
 * @category Application
 *
 * @author   dark
 * @created  06.02.13 18:16
 */
namespace Application;

use Bluz\Http\File;

return
/**
 * @privilege Upload
 */
function () {
    /**
     * @var Bootstrap $this
     * @var \Bluz\Http\FileUpload $fileUpload
     */
    $fileUpload = $this->getRequest()->getFileUpload();
    $file = $fileUpload->getFile('file');

    if ($file && $file->getType() == File::TYPE_IMAGE) {
        // save original name
        $original = $file->getName();
        // rename file to date/time stamp
        $file->setName(date('Ymd_Hi'));

        // switch to JSON response
        $this->useJson();

        if (!$this->user()) {
            throw new Exception('User not found');
        }

        $userId = $this->user()->id;

        // directory structure:
        //   uploads/
        //     %userId%/
        //       %module%/
        //         filename.ext
        $file->moveTo(PATH_PUBLIC .'/uploads/'.$userId.'/media');

        // save media data
        $media = new Media\Row();
        $media->userId = $userId;
        $media->module = 'media';
        $media->type = $file->getMimeType();
        $media->title = $original;
        $media->file = 'uploads/'.$userId.'/media/'.$file->getFullName();

        $media->preview = $media->file;
        $media->save();

        // displaying file
        return array(
            'filelink' =>  $media->file
        );

    } else {
        throw new Exception('Wrong file type');
    }
};
