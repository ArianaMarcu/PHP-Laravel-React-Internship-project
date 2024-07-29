<div>
    <button type="button" class="btn btn-primary float-end">View Profile</button>
    <ul class="list-unstyled mb-0">
        @foreach($users as $user)
            <li>
                <a href="#">{{ $user->name }}</a>
            </li>        @endforeach
    </ul>
</div>
