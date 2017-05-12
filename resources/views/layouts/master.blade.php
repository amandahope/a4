<!DOCTYPE html>
<html>
<head>
	<title>Delegate It! - Task List</title>
	<meta charset='utf-8'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="/css/delegateit.css" type='text/css' rel='stylesheet'>
</head>

<body>

    <div class="container-fluid">

        <header>
            <h1 class="text-center">Delegate It!
                <small>Task Management for Teams</small>
            </h1>

        </header>

        @if(Session::get('message') != null)
            <div class="alert alert-warning">{{ Session::get('message') }}</div>
        @endif

        <nav>
            <ul class="nav nav-tabs">
                <li role="presentation" @if ($active == "add") class="active" @endif><a href="/new">Add A Task</a></li>
                <li role="presentation" @if ($active == "index") class="active" @endif><a href="/">View All Tasks</a></li>
                <li role="presentation" @if ($active == "my") class="active" @endif><a href="/mytasks">View My Tasks</a></li>
                <li role="presentation" class="dropdown @if ($active == "team") active @endif ">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        View Tasks By Team Member
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($membersForCheckboxes as $id => $name)
                            <li><a href="/{{ $id }}">{{ $name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li role="presentation" @if ($active == "manage") class="active" @endif><a href="/team">Manage Team</a></li>
            </ul>
        </nav>

        @yield('content')

    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/js/delegate_it.js" type="text/javascript"></script>

</body>
</html>
