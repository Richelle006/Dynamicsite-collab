<?php
            <th>Booking ID</th>
            <th>Booking Date</th>
            <th>Service</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['booking_id']; ?></td>
            <td><?php echo $row['booking_date']; ?></td>
            <td><?php echo $row['service_id']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
                <a href="edit_booking.php?id=<?php echo $row['booking_id']; ?>">Edit</a>
                <a href="delete_booking.php?id=<?php echo $row['booking_id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>