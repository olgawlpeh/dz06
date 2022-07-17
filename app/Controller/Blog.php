<?php
namespace App\Controller;

use App\Model\Eloquent\Message;
use Base\AbstractController;

class Blog extends AbstractController
{
    /**
     * @throws \Base\RedirectException
     */
    public function index(): string
    {
        if (!$this->getUser()) {
            $this->redirect('/login');
        }
        $messages = Message::getList();
//        if ($messages) {
//            $userIds = array_map(function (Message $message) {
//                return $message->getAuthorId();
//            }, $messages);
//            $users = \App\Model\Eloquent\User::getByIds($userIds);
//            array_walk($messages, function (Message $message) use ($users) {
//                if (isset($users[$message->getAuthorId()])) {
//                    $message->setAuthor($users[$message->getAuthorId()]);
//                }
//            });
//        }
        return $this->view->render('blog.phtml', [
            'messages' => $messages,
            'user' => $this->getUser()
        ]);
    }

    /**
     * @throws \Base\RedirectException
     */
    public function addMessage()
    {
        if (!$this->getUser()) {
            $this->redirect('/login');
        }

        $text = (string) $_POST['text'];
        if (!$text) {
            $this->error('Сообщение не может быть пустым');
        }

        $message = new Message([
            'text' => $text,
            'author_id' => $this->getUserId(),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if (isset($_FILES['image']['tmp_name'])) {
            $message->loadFile($_FILES['image']['tmp_name']);
        }

        $message->save();
        $this->redirect('/blog');

    }
    public function twig()
    {
        return $this->view->renderTwig('test.twig', ['var' => 'ololo']);
    }

    private function error()
    {

    }
}