<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


$formHandler = new FormHandler();
$currentPage = $formHandler->getCurrentPage();
$formData = $formHandler->getFormData();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Formular</title>
    <!-- Deine CSS und JavaScript Einbindungen -->
</head>

<body>

    <?php if ($currentPage == 1): ?>
        <!-- Seite 1 -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <?php echo $formData->renderHiddenFields(); ?>

            <input type="checkbox" name="agb" value="checked" <?php echo isset($formData->agb) && $formData->agb == 'checked' ? 'checked' : ''; ?>>
            <button type="submit" name="btn" value="topage2">Weiter</button>
        </form>

    <?php elseif ($currentPage == 2): ?>
        <!-- Seite 2 -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <?php echo $formData->renderHiddenFields(); ?>

            <input type="text" name="hundhaltungsdatum"
                value="<?php echo htmlspecialchars($formData->hundhaltungsdatum); ?>">
            <!-- Weitere Felder für Seite 2 -->
            <button type="submit" name="btn" value="backpage1">Zurück</button>
            <button type="submit" name="btn" value="topage3">Weiter</button>
        </form>

    <?php elseif ($currentPage == 3): ?>
        <!-- Seite 3 -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <?php echo $formData->renderHiddenFields(); ?>

            <input type="text" name="vname" value="<?php echo htmlspecialchars($formData->vname); ?>">
            <input type="text" name="nname" value="<?php echo htmlspecialchars($formData->nname); ?>">
            <!-- Weitere Felder für Seite 3 -->
            <button type="submit" name="btn" value="backpage2">Zurück</button>
            <button type="submit" name="btn" value="topage4">Weiter</button>
        </form>

    <?php elseif ($currentPage == 4): ?>
        <!-- Seite 4 -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <?php echo $formData->renderHiddenFields(); ?>

            <input type="text" name="hname" value="<?php echo htmlspecialchars($formData->hname); ?>">
            <input type="text" name="hrasse" value="<?php echo htmlspecialchars($formData->hrasse); ?>">
            <!-- Weitere Felder für Seite 4 -->
            <button type="submit" name="btn" value="backpage3">Zurück</button>
            <button type="submit" name="btn" value="topage5">Weiter</button>
        </form>

        <!-- Weitere Seiten hier -->

    <?php endif; ?>

</body>

</html>