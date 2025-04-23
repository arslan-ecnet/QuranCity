<footer class="footer">
    <ul>
        <?php
        $year = now()->format('Y')
        ?>
        <li>Copyright © {{$year}} QFatima. All rights reserved.</li>
        <li>Developed by <img src="{{asset('images/footer-icon.png')}}" alt=""></li>
    </ul>
</footer>
