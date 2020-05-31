<?php

session_start();

$showForm = true;

if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
    unset($_SESSION['inputs']);
    $showForm = false;
}

$inputs = [
    'fullname' => $_SESSION['inputs']['fullname'] ?? '',
    'email' => $_SESSION['inputs']['email'] ?? '',
    'house_id' => $_SESSION['inputs']['house_id'] ?? '',
    'password' => $_SESSION['inputs']['password'] ?? '',
];

function getTitle()
{
    return 'Kayıt Ol';
}

$config = include 'config.php';

include 'header.php';

include 'navbar.php';

include "Input.php";

include "Request.php";
?>

    <div class="pt-5">

        <div class="container">

            <section class="jumbotron text-center pt-5 mb-5 bg-white">
                <div class="container">
                    <h1 class="jumbotron-heading"><?php echo getTitle(); ?></h1>
                </div>
            </section>

            <div class="bg-white p-5">

                <?php
                if (isset($_SESSION['errors'])):
                    if (count($_SESSION['errors']) > 0) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Form'da bazı hatalarla karşılaşıldı!</strong>
                        </div>
                <?php
                } else {
                ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Tebrikler! Potterhead'e hoş geldiniz!</strong>
                        </div>
                <?php
                }
                endif;
                ?>

                <?php if ($showForm): ?>
                    <form name="registerForm" method="POST" action="action.php">
						<?php
						Input::text("İsim Soyisim", "fullname", $inputs['fullname']);
						Input::text("Eposta Adresi", "email", $inputs['email'], ["type" => "email"]);
						Input::select("Bina","house_id", $inputs['house_id'],$config['validHouses'],["asd"=>"asd"]);
						Input::text("Parola", "password", "", ["type" => "password"]); ?>
                        <button name="submit" value="1" type="submit" class="btn btn-primary">Kayıt Ol</button>
                    </form>
				<?php endif; ?>
            </div>
        </div>
    </div>

<?php

session_destroy();

include 'footer.php';
