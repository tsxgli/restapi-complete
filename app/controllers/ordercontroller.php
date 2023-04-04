<?php
namespace Controllers;

use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/../vendor/autoload.php';
use Exception;
use Services\MovieService;
use Services\OrderService;
use Models\Order;

class OrderController
{
    private $orderService;
    private $movieService;

    function __construct()
    {
        $this->orderService = new OrderService();
        $this->movieService = new MovieService();
    }

    public function paymentSuccessful()
    {
        require __DIR__ . '/../views/order/paymentSuccessful.php';
    }
    public function index()
    {
        require __DIR__ . '/../views/order/index.php';
    }

    public function buyMovie()
    {
        $order = new Order();
        $order = $this->createObjectFromPostedJson("Models\\Order");
        $this->orderService->insertOrder($order);

        $this->sendEmail($order->emailAddress);
        $this->movieService->updateStock($order->getMovieID());
        require __DIR__ . '/../views/order/paymentSuccessful.php';

    }

    public function getAllOrders()
    {
        $model = $this->orderService->getAll();
        require __DIR__ . '/../views/admin/orderhistory.php';
    }

    public function sendEmail($emailAddress)
    {
        require __DIR__ . '/../config/phpmailerconfig.php'; 
        // Instantiate a new PHPMailer object
        $mail = new PHPMailer;

        // Set the mailer to use SMTP
        $mail->isSMTP();

        // Specify the SMTP server details
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $email;
        $mail->Password = $password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Set the sender and recipient email addresses
        $mail->setFrom($email, 'WMovies');
        $mail->addAddress($emailAddress, '');

        // Set the subject and message body
        $mail->Subject = 'Movie Purchase';
        $mail->Body = 'Your movie purchase was successful. Here is your link to the movie: https://www.youtube.com/watch?v=d9MyW72ELq0&t=5s ';

        // Check if the email was sent successfully
        if (!$mail->send()) {
            echo 'Error: ' . $mail->ErrorInfo;
        } else {
            // echo 'Email sent successfully!';
        }

    }

}

?>