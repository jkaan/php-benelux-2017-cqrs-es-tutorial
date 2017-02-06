<?php
/* @var \Rhumsaa\Uuid\Uuid $buildingId */
/* @var string[] $currentlyCheckedInUsers */
?>
<h1>Welcome to CQRS+ES building</h1>

<h2>Check In: </h2>
<form action="/checkin/<?= $buildingId; ?>" method="post">
    <input type="text" name="username" placeholder="Enter your username to checkin" required="required"/>

    <button>CheckIn</button>
</form>

<h2>Check Out: </h2>
<form action="/checkout/<?= $buildingId; ?>" method="post">
    <input type="text" name="username" placeholder="Enter your username to checkout" required="required"/>

    <button>CheckOut</button>
</form>

<h3>Users that are currently checked in: </h3>
<ul>
    <?php foreach ($currentlyCheckedInUsers as $user) : ?>
        <li><?php echo $user; ?></li>
    <?php endforeach; ?>
</ul>
