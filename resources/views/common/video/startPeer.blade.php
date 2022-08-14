@extends('layouts.user')
@section('content')
    <style>
        main {
            width: 100%;
            margin: 0 auto;
            height: 75vh;
        }

        #site-title {
            font-family: 'Permanent Marker', cursive;
        }


        /* #join-wrapper {
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        } */


        #username {
            padding: 20px;
            font-size: 18px;
            border-radius: 10px;
            border: none;
            margin: 10px;
        }

        .volume-icon {
            height: 20px;
            width: 20px;
        }

        /* #join-btn {

            background-color: #1f1f1f8e;
            border: none;
            color: #fff;
            font-size: 22px;
            padding: 20px 30px;
            cursor: pointer;
        } */


        #user-streams {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(600px, 1fr));
            gap: 1em;
            height: 100%;
        }


        .video-player {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
        }

        .video-containers {
            position: relative;
            padding: 0;
            margin: 0;
            background-color: #1f1f1f8e;
            border-radius: 10px;

        }

        .user-uid {
            display: flex;
            align-items: center;
            column-gap: 1em;
            background-color: #1f1f1f8e;
            padding: 5px 10px;
            border-radius: 5px;
            position: absolute;
            bottom: 10px;
            left: 10px;
            z-index: 9999;
            margin: 0;
            font-size: 18px;
        }


        #footer {
            position: absolute;
            bottom: 0;
            left: 0;
            display: none;
            justify-content: center;
            column-gap: 1em;
            width: 100%;
            height: 100px;
        }

        .icon-wrapper {
            justify-content: center;
            text-align: center;
            cursor: pointer;
        }

        .control-icon {
            display: block;
            padding: 15px;
            background-color: #1f1f1f8e;
            height: 30px;
            width: 30px;
            border-radius: 10px;
        }


        @media screen and (max-width:1400px) {
            main {
                width: 90%;
                margin: 0 auto;
            }
        }
    </style>
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Peer Conference</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Peer Conference</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->


                <!-- ROW-1 OPEN -->
                <!-- Row -->
                @if ($peer->type != 1)
                <div class="row ">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Conference Informations</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-xl-6 mb-3">
                                        <h3>Name:</h3>
                                        {{ $peer->name }}
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <h3>Date:</h3>
                                        @if ($peer->programed == null)
                                            ---
                                        @else
                                            {{ date('Y-m-d H:i', (int) $peer->programed) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 mb-3">
                                        <h3>Creator Name:</h3>
                                        {{ $creator->name }}
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <h3>Creator Email:</h3>
                                        {{ $creator->email }} ... <a href="/user-view/{{ $creator->id }}">view creator
                                            informations</a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-12 mb-3">
                                        <h3>Description:</h3>
                                        {{ $peer->description }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                @endif
                <!-- /Row -->



                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" id="join-wrapper">
                                <button id="join-btn" class="btn btn-primary" >Start Meeting</button>
                            </div>
                            <div class="card-body">
                                {{-- <iframe src="{{ env('PEER_CHAT_URL')."/index.html?room=".$peer->id}}" ref="camera" allow="camera;microphone" width="100%" height="650px" frameborder="0">
                                </iframe> --}}


                                <script>
                                    var room = "{{ $peer->room_id }}";
                                    var user_name = "{{ Auth::user()->name }}";
                                    var user_id = {{ Auth::user()->id }};
                                </script>
                                <main>

                                    <!-- <div id="users-list"></div> -->

                                    {{-- <div id="join-wrapper"> --}}
                                        {{-- <input id="username" type="text" placeholder="Enter your name..." /> --}}
                                        {{-- <button id="join-btn" class="btn btn-primary">Join Stream</button>
                                    </div> --}}
                                    <div id="user-streams"></div>



                                    <!-- Wrapper for join button -->
                                    <div id="footer">
                                        <div class="icon-wrapper">
                                            <img class="control-icon" id="camera-btn" src="../../assets/svg/video.svg" />
                                            <p>Cam</p>
                                        </div>

                                        <div class="icon-wrapper">
                                            <img class="control-icon" id="mic-btn" src="../../assets/svg/microphone.svg" />
                                            <p>Mic</p>
                                        </div>

                                        <div class="icon-wrapper">
                                            <img class="control-icon" id="leave-btn" src="../../assets/svg/leave.svg" />
                                            <p>Leave</p>
                                        </div>

                                    </div>

                                </main>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->


    <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>
    <script>
        //#1
        let client = AgoraRTC.createClient({
            mode: 'rtc',
            codec: "vp8"
        })

        //#2
        let config = {
            appid: "e03d5ac1deba4b8f9a8c4ad0942200f5",
            // token: "00620e215c3b9a249f4b6b7225935c23807IADY6ZaBrsZ3SYoik6nQQJJ/edKKIVBcxEUxDv/4rm6r6gx+f9jNRFNPEACYKhVdaEvsYgEAAQDo8+ti",
            uid: user_name,
            channel: room,
        }

        //#3 - Setting tracks for when user joins
        let localTracks = {
            audioTrack: null,
            videoTrack: null
        }

        //#4 - Want to hold state for users audio and video so user can mute and hide
        let localTrackState = {
            audioTrackMuted: false,
            videoTrackMuted: false
        }

        //#5 - Set remote tracks to store other users
        let remoteTracks = {}


        document.getElementById('join-btn').addEventListener('click', async () => {
            await joinStreams()
            document.getElementById('join-wrapper').style.display = 'none'
            document.getElementById('footer').style.display = 'flex'
        })

        document.getElementById('mic-btn').addEventListener('click', async () => {
            //Check if what the state of muted currently is
            //Disable button
            if (!localTrackState.audioTrackMuted) {
                //Mute your audio
                await localTracks.audioTrack.setMuted(true);
                localTrackState.audioTrackMuted = true
                document.getElementById('mic-btn').style.backgroundColor = 'rgb(255, 80, 80, 0.7)'
            } else {
                await localTracks.audioTrack.setMuted(false)
                localTrackState.audioTrackMuted = false
                document.getElementById('mic-btn').style.backgroundColor = '#1f1f1f8e'

            }

        })



        document.getElementById('camera-btn').addEventListener('click', async () => {
            //Check if what the state of muted currently is
            //Disable buttonr
            if (!localTrackState.videoTrackMuted) {
                //Mute your audio
                await localTracks.videoTrack.setMuted(true);
                localTrackState.videoTrackMuted = true
                document.getElementById('camera-btn').style.backgroundColor = 'rgb(255, 80, 80, 0.7)'
            } else {
                await localTracks.videoTrack.setMuted(false)
                localTrackState.videoTrackMuted = false
                document.getElementById('camera-btn').style.backgroundColor = '#1f1f1f8e'

            }

        })



        document.getElementById('leave-btn').addEventListener('click', async () => {
            //Loop threw local tracks and stop them so unpublish event gets triggered, then set to undefined
            //Hide footer
            for (trackName in localTracks) {
                let track = localTracks[trackName]
                if (track) {
                    track.stop()
                    track.close()
                    localTracks[trackName] = null
                }
            }

            //Leave the channel
            await client.leave()
            document.getElementById('footer').style.display = 'none'
            document.getElementById('user-streams').innerHTML = ''
            document.getElementById('join-wrapper').style.display = 'block'

        })




        //Method will take all my info and set user stream in frame
        let joinStreams = async () => {
            //Is this place hear strategicly or can I add to end of method?

            client.on("user-published", handleUserJoined);
            client.on("user-left", handleUserLeft);


            client
                .enableAudioVolumeIndicator(); // Triggers the "volume-indicator" callback event every two seconds.
            client.on("volume-indicator", function(evt) {
                for (let i = 0; evt.length > i; i++) {
                    let speaker = evt[i].uid
                    let volume = evt[i].level
                    if (volume > 0) {
                        document.getElementById(`volume-${speaker}`).src = '../../assets/svg/volume-on.svg'
                    } else {
                        document.getElementById(`volume-${speaker}`).src = '../../assets/svg/volume-off.svg'
                    }



                }
            });

            //#6 - Set and get back tracks for local user
            [config.uid, localTracks.audioTrack, localTracks.videoTrack] = await Promise.all([
                client.join(config.appid, config.channel, config.token || null, config.uid || null),
                AgoraRTC.createMicrophoneAudioTrack(),
                AgoraRTC.createCameraVideoTrack()

            ])

            //#7 - Create player and add it to player list
            let player = `<div class="video-containers" id="video-wrapper-${config.uid}">
                        <p class="user-uid"><img class="volume-icon" id="volume-${config.uid}" src="../../assets/svg/volume-on.svg" /> ${config.uid}</p>
                        <div class="video-player player" id="stream-${config.uid}"></div>
                  </div>`

            document.getElementById('user-streams').insertAdjacentHTML('beforeend', player);
            //#8 - Player user stream in div
            localTracks.videoTrack.play(`stream-${config.uid}`)


            //#9 Add user to user list of names/ids

            //#10 - Publish my local video tracks to entire channel so everyone can see it
            await client.publish([localTracks.audioTrack, localTracks.videoTrack])

        }


        let handleUserJoined = async (user, mediaType) => {
            console.log('Handle user joined')

            //#11 - Add user to list of remote users
            remoteTracks[user.uid] = user

            //#12 Subscribe ro remote users
            await client.subscribe(user, mediaType)


            if (mediaType === 'video') {
                let player = document.getElementById(`video-wrapper-${user.uid}`)
                console.log('player:', player)
                if (player != null) {
                    player.remove()
                }

                player = `<div class="video-containers" id="video-wrapper-${user.uid}">
                        <p class="user-uid"><img class="volume-icon" id="volume-${user.uid}" src="../../assets/svg/volume-on.svg" /> ${user.uid}</p>
                        <div  class="video-player player" id="stream-${user.uid}"></div>
                      </div>`
                document.getElementById('user-streams').insertAdjacentHTML('beforeend', player);
                user.videoTrack.play(`stream-${user.uid}`)




            }


            if (mediaType === 'audio') {
                user.audioTrack.play();
            }
        }


        let handleUserLeft = (user) => {
            console.log('Handle user left!')
            //Remove from remote users and remove users video wrapper
            delete remoteTracks[user.uid]
            document.getElementById(`video-wrapper-${user.uid}`).remove()
        }
    </script>
@endsection
