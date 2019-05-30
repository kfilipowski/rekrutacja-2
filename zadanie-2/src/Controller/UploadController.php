<?php

namespace App\Controller;

use Smarty;
use App\Service\ReaderInterface;
use App\Service\UploaderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class UploadController
{
    const INFO_ERROR_TYPE   = 'error';
    const INFO_SUCCESS_TYPE = 'success';

    /** @var Smarty */
    private $smarty;

    /** @var UploaderInterface */
    private $uploader;

    /** @var ReaderInterface */
    private $reader;

    /**
     * Controller constructor.
     * @param UploaderInterface $uploader
     * @param ReaderInterface $reader
     * @param Smarty $smarty
     */
    public function __construct(UploaderInterface $uploader, ReaderInterface $reader, Smarty $smarty)
    {
        $this->reader   = $reader;
        $this->uploader = $uploader;
        $this->smarty   = $smarty;
    }

    /**
     * @return Response
     * @throws \SmartyException
     */
    public function files(): Response
    {
        $this->smarty->assign(['files' => $this->reader->readFiles()]);
        $content = $this->smarty->fetch('../templates/index.tpl');
        return new Response($content);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \SmartyException
     */
    public function upload(Request $request): Response
    {
        $info = [];

        try {
            if ($request->files->count()) {
                $this->uploader->upload($request->files->all());
                $info = [
                    'type'    => self::INFO_SUCCESS_TYPE,
                    'content' => 'Uploaded success.'
                ];
            }
        } catch(\Exception $e) {
            $info = [
                'type'    => self::INFO_ERROR_TYPE,
                'content' => $e->getMessage()
            ];
        }
        return new JsonResponse([
            'info'  => $info,
            'files' => $this->renderFilesView()
        ]);
    }

    /**
     * @return string
     * @throws \SmartyException
     */
    private function renderFilesView(): string
    {
        $this->smarty->assign(['files' => $this->reader->readFiles()]);
        return $this->smarty->fetch('../templates/_files.tpl');
    }
}
