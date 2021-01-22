const player = document.querySelector('.player');
const video = player.querySelector('.viewer');
const per = document.querySelector('.cal'); //completed coures
const setIt = document.querySelector('.set'); //last playback.....
// const send = document.querySelector("set_ti");
const send = document.querySelector('.set_time');
// const zzz = document.querySelector('.xyz');

const getdata = document.getElementById("cal");
const completed = document.getElementById("complete");
const cong = document.getElementById("cong");

function handaleProgress() {
    const precent = (video.currentTime / video.duration) * 100;

    // progressBar.style.flexBasis = `${precent}%`;

    // console.log(precent);
    if (parseInt(precent) == 100) {
        // location.href("Location: videocourse.php");
        completed.innerHTML = "Finished!";
        // cong.innerHTML = "Congratulations ! You Successfully Completed This Course."
        // location.href("Location: videocourse.php");
        location.reload(true);
        // window.history.back();
        video.currentTime = 0;

    }
    per.innerHTML = parseInt(precent) + "%";
    getdata.value = parseInt(precent) + "%";

}

function getCurTime() {
    // setIt.innerHTML = "The Last playback position is " + parseInt(video.currentTime) + " seconds.";
    set_ti.value = parseInt(video.currentTime);

}

const xyz = document.getElementById("set_time").value;


function setCurTime() {
    // video.currentTime = 5;

    // $("video").on("canplay", function() {
    //     video.setCurTime = xyz;
    //     $("video").off("canplay");
    // })

    console.log(xyz);
    console.log(video.duration);
    console.log(video.played);



    video.currentTime = xyz;

    if(parseInt(video.currentTime) == parseInt(video.duration))
    {
        console.log("i am call");
        video.currentTime = 0;
    }
}





video.addEventListener('timeupdate', handaleProgress);
video.addEventListener("timeupdate", getCurTime);
// video.addEventListener("canplay", setCurTime);
video.addEventListener("play", setCurTime);
// video.addEventListener("click", setCurTime);
video.addEventListener("pause", setCurTime);
// video.addEventListener("seeking",playLast);
// video.addEventListener("click",setCurTime);