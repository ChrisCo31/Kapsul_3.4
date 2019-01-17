<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 17/01/2019
 * Time: 09:38
 */

namespace CTS\KapsBundle\Services;


use CTS\KapsBundle\Entity\User;
use Swift_Mailer;
use Symfony\Component\Templating\EngineInterface;

class SendEmail
{
    private $mailer;
    private $templating;

    /**
     * SendEmail constructor.
     * @param Swift_Mailer $mailer
     * @param EngineInterface $templating
     */
    public function __construct(Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * @param $subject
     * @param $from
     * @param $to
     * @param $format
     * @param $body
     */
    public function createEmail($subject, $from, $to, $format, $body)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setContentType($format)
            ->setBody($body);
        $this->mailer->send($message);
    }

    public function sendEmail(User $user)
    {
        $email = $user->getEmail();
        $subject = 'reinitialisation de votre mot de passe';
        $from = 'coeuranger.pastel@gmail.com';
        $to = $email;
        $format = 'text/html';
        $body = $this->templating->render(
            'CTSKapsBundle:Emails:resetProcess.html.twig');
        $this->createEmail($subject, $from, $to, $format, $body);
    }

}