<nav class="navbar navbar-light bg-light navbar-expand-md">
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myNavbar">&#x2630;
    </button>
    <a class="navbar-brand" href="{{ URL::to('/') }}">{{ env('APP_NAME') }}</a>


    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            @if (Auth::check() && Auth::user()->hasCharacter())
                <li class="nav-item button">
                    <a href="{{ route('character.show', ['character' => Auth::user()->character]) }}" class="nav-link">
                        <span class="fa fa-user-circle" aria-hidden="true">
                        {{ _t('Character') }}
                        </span>
                    </a>
                </li>
                <li class="nav-item button">
                    <a href="{{ route('location.show', ['location' => Auth::user()->character->location]) }}" class="nav-link">
                        <span class="fa fa-university" aria-hidden="true">
                            {{ _t('Location') }}
                        </span>
                    </a>
                </li>
                <li class="nav-item button">
                    <a href="{{ URL::route('message.inbox') }}" class="nav-link">
                        <span class="fa fa-envelope">
                            {{ _t('Messages') }}
                            @if(Auth::user()->character->receivedMessages()->unread()->count() > 0)
                                <span class="badge badge-danger">
                                     {{ Auth::user()->character->receivedMessages()->unread()->count() }}
                                </span>
                            @endif
                        </span>
                    </a>
                </li>
                <li class="nav-item button">
                    <a href="{{ URL::route('character.battle.index', ['character' => Auth::user()->character]) }}" class="nav-link">
                        <span class="fas fa-bolt">
                            {{ _t('Battles') }}
                            @if(Auth::user()->character->defends()->unseenByDefender()->count() > 0)
                                <span class="badge badge-danger">
                                     {{ Auth::user()->character->defends()->unseenByDefender()->count() }}
                                </span>
                            @endif
                        </span>
                    </a>
                </li>
            @endif
        </ul>
        <ul class="nav navbar-nav ml-auto">
            @if (Auth::check())
                @if (Auth::user()->hasCharacter() && Auth::user()->character->hasProfilePicture())
                    <li class="nav-item nav-avatar d-flex">
                        <a class="align-self-baseline" href="{{ route('character.show', ['character' => Auth::user()->character]) }}">
                            <img class="profile-picture-nav"
                                 src="{{ asset(Auth::user()->character->getProfilePictureSmall()) }}"
                                 alt="Avatar">
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <form role="form" method="POST" action="{{ route('logout') }}">
                            {{ csrf_field() }}
                            <button type="submit"><span class="glyphicon glyphicon-log-out"></span> {{ _t('Logout') }}</button>
                        </form>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ URL::to('register') }}" class="nav-link">
                            <span class="glyphicon glyphicon-user">
                            </span> {{ _t('Register') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('login') }}" class="nav-link">
                            <span class="glyphicon glyphicon-log-in">
                            </span> {{ _t('Login') }}
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>