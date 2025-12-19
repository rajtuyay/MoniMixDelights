document.getElementById('nav0').addEventListener('mouseover', function() {
    document.getElementById('nav1').style.opacity = '0.5';
    document.getElementById('nav2').style.opacity = '0.5';
    document.getElementById('nav3').style.opacity = '0.5';
    document.getElementById('nav4').style.opacity = '0.5';
});

document.getElementById('nav0').addEventListener('mouseout', function() {
    document.getElementById('nav1').style.opacity = '1';
    document.getElementById('nav2').style.opacity = '1';
    document.getElementById('nav3').style.opacity = '1';
    document.getElementById('nav4').style.opacity = '1';
});

document.getElementById('nav1').addEventListener('mouseover', function() {
    document.getElementById('nav0').style.opacity = '0.5';
    document.getElementById('nav2').style.opacity = '0.5';
    document.getElementById('nav3').style.opacity = '0.5';
    document.getElementById('nav4').style.opacity = '0.5';
});

document.getElementById('nav1').addEventListener('mouseout', function() {
    document.getElementById('nav0').style.opacity = '1';
    document.getElementById('nav2').style.opacity = '1';
    document.getElementById('nav3').style.opacity = '1';
    document.getElementById('nav4').style.opacity = '1';
});

document.getElementById('nav2').addEventListener('mouseover', function() {
    document.getElementById('nav0').style.opacity = '0.5';
    document.getElementById('nav1').style.opacity = '0.5';
    document.getElementById('nav3').style.opacity = '0.5';
    document.getElementById('nav4').style.opacity = '0.5';
});

document.getElementById('nav2').addEventListener('mouseout', function() {
    document.getElementById('nav0').style.opacity = '1';
    document.getElementById('nav1').style.opacity = '1';
    document.getElementById('nav3').style.opacity = '1';
    document.getElementById('nav4').style.opacity = '1';
});

document.getElementById('nav3').addEventListener('mouseover', function() {
    document.getElementById('nav0').style.opacity = '0.5';
    document.getElementById('nav1').style.opacity = '0.5';
    document.getElementById('nav2').style.opacity = '0.5';
    document.getElementById('nav4').style.opacity = '0.5';
});

document.getElementById('nav3').addEventListener('mouseout', function() {
    document.getElementById('nav0').style.opacity = '1';
    document.getElementById('nav1').style.opacity = '1';
    document.getElementById('nav2').style.opacity = '1';
    document.getElementById('nav4').style.opacity = '1';
});

document.getElementById('nav4').addEventListener('mouseover', function() {
    document.getElementById('nav0').style.opacity = '0.5';
    document.getElementById('nav1').style.opacity = '0.5';
    document.getElementById('nav2').style.opacity = '0.5';
    document.getElementById('nav3').style.opacity = '0.5';
});

document.getElementById('nav4').addEventListener('mouseout', function() {
    document.getElementById('nav0').style.opacity = '1';
    document.getElementById('nav1').style.opacity = '1';
    document.getElementById('nav2').style.opacity = '1';
    document.getElementById('nav3').style.opacity = '1';
});

document.addEventListener('DOMContentLoaded', function() {
    var na1 = document.getElementById('na1');
    if (na1) {
        na1.addEventListener('mouseover', function() {
            setOpacity(['na2', 'na3', 'na4', 'na5'], 0.5);
        });

        na1.addEventListener('mouseout', function() {
            setOpacity(['na2', 'na3', 'na4', 'na5'], '');
        });
    }
});

function setOpacity(ids, value) {
    ids.forEach(function(id) {
        var element = document.getElementById(id);
        if (element) {
            element.style.opacity = value;
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var na2 = document.getElementById('na2');
    if (na2) {
        na2.addEventListener('mouseover', function() {
            setOpacity(['na1', 'na3', 'na4', 'na5'], 0.5);
        });

        na2.addEventListener('mouseout', function() {
            setOpacity(['na1', 'na3', 'na4', 'na5'], '');
        });
    }
});

function setOpacity(ids, value) {
    ids.forEach(function(id) {
        var element = document.getElementById(id);
        if (element) {
            element.style.opacity = value;
        }
    });
}


document.addEventListener('DOMContentLoaded', function() {
    var na3 = document.getElementById('na3');
    if (na3) {
        na3.addEventListener('mouseover', function() {
            setOpacity(['na1', 'na2', 'na4', 'na5'], 0.5);
        });

        na3.addEventListener('mouseout', function() {
            setOpacity(['na1', 'na2', 'na4', 'na5'], '');
        });
    }
});

function setOpacity(ids, value) {
    ids.forEach(function(id) {
        var element = document.getElementById(id);
        if (element) {
            element.style.opacity = value;
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var na4 = document.getElementById('na4');
    if (na4) {
        na4.addEventListener('mouseover', function() {
            setOpacity(['na1', 'na2', 'na3', 'na5'], 0.5);
        });

        na4.addEventListener('mouseout', function() {
            setOpacity(['na1', 'na2', 'na3', 'na5'], '');
        });
    }
});

function setOpacity(ids, value) {
    ids.forEach(function(id) {
        var element = document.getElementById(id);
        if (element) {
            element.style.opacity = value;
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var na5 = document.getElementById('na5');
    if (na5) {
        na5.addEventListener('mouseover', function() {
            setOpacity(['na1', 'na2', 'na3', 'na4'], 0.5);
        });

        na5.addEventListener('mouseout', function() {
            setOpacity(['na1', 'na2', 'na3', 'na4'], '');
        });
    }
});

function setOpacity(ids, value) {
    ids.forEach(function(id) {
        var element = document.getElementById(id);
        if (element) {
            element.style.opacity = value;
        }
    });
}