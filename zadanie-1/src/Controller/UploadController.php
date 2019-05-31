<?php

namespace App\Controller;

use Smarty;
use App\Service\ReaderInterface;
use App\Service\UploaderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

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
     * @param Session $session
     * @return Response
     * @throws \SmartyException
     */
    public function files(Session $session): Response
    {
        $this->smarty->assign([
            'info'  => $session->getFlashBag()->get('info'),
            'files' => $this->reader->readFiles()
        ]);
        $content = $this->smarty->fetch('../templates/index.tpl');
        return new Response($content);
    }

    /**
     * @param Request $request
     * @param Session $session
     * @return Response
     */
    public function upload(Request $request, Session $session): Response
    {
        try {
            if ($request->request->has('submit')) {
                $this->uploader->upload($request->files->all());
                $session->getFlashBag()->add('info', [
                    'type'    => self::INFO_SUCCESS_TYPE,
                    'content' => 'Uploaded success.'
                ]);
            }
        } catch(\Exception $e) {
            $session->getFlashBag()->add('info', [
                'type'    => self::INFO_ERROR_TYPE,
                'content' => $e->getMessage()
            ]);
        }
        return new RedirectResponse(
            $request->server->get('PHP_SELF')
        );
    }
}
