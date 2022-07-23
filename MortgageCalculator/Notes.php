<?php

$schedule = $amortization['schedule'];
//This is how to make a table for the schedule.
?>

<table>
    <thead>
        <tr>
            <th>Payment</th>
            <th>Interest</th>
            <th>Principal</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($schedule as $term_detail): ?>
        <tr>
            <td><?= $term_detail['payment'] ?></td>
            <td><?= $term_detail['interest'] ?></td>
            <td><?= $term_detail['principal'] ?></td>
            <td><?= $term_detail['balance'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>