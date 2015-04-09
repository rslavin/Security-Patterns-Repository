// DEREK DIAZ CORREA 
// visipattern.js
// Main logic to generate pattern diagrams.

var nodes = null;
var edges = null;
var network = null;
var patterns = [];
var parents = [];
var childs = [];
var siblings = [];
var ors = [];
var patternToDraw;
var nodePatterns = [];
var edgePatterns = [];

$(document).ready(function () {

    //IDs to use
    //79 = Face Recognition (Has Siblings) - OK!
    //98 = Access Control (Has an Exclusive OR) - OK!
    //93 = Authorization (Top Pattern!) - OK!
    //151 = Credentials (Has Child Incluive OR) - OK? Check if arrow is supposed to be pointing downwards!
    //73 = I&A Has no Childs and only one parent! - OK!

    var url = window.location.href;
    patternToDraw = url.substr(url.lastIndexOf('/') + 1);

    //Get Data
    getParents(patternToDraw);
    getChilds(patternToDraw);
    getPatterns();
});

//Continue tree generation after ajax calls are done!
$(document).ajaxStop(function () {

    setTimeout(function () {
        populateNodes();
        linkNodes();
        draw();
    }, 1000);


});

function populateNodes() {
    //Shapes: circle, box, database, image, circularImage, label, dot, star, triangle, triangleDown, square and icon. 
    //Parents
    var l = parents.length;
    if (l > 0) {
        for (var i = 0; i < l; i++) {
            if (!checkExisting(parents[i].parent_id)) {
                if (parents[i].parent_id != patternToDraw) {
                    pat = findPattern(parents[i].parent_id);
                    if (pat != null) {
                        nodePatterns.push({
                            id: pat.pattern_id,
                            label: pat.title,
                            shape: 'box',
                            group: 'group_0',
                            level: '0'
                        });
                        if (parents[i].relation_type == "I" || parents[i].relation_type == "E") {
                            ors.push({
                                relation: parents[i].relation_type,
                                group: parents[i].group,
                                family: "parent",
                                pattern: parents[i].parent_id
                            });
                        }

                    }
                }

            }
        }
    }

    //Main Pattern
    var pat = findPattern(patternToDraw);
    if (pat != null) {
        nodePatterns.push({
            id: pat.pattern_id,
            label: pat.title,
            shape: 'box',
            group: 'group_2',
            level: '2'
        });
    }

    //Siblings
    l = siblings.length;
    if (l > 0) {
        for (var i = 0; i < l; i++) {
            if (!checkExisting(siblings[i].pattern_id)) {
                pat = findPattern(siblings[i].pattern_id);
                if (pat != null) {
                    nodePatterns.push({
                        id: pat.pattern_id,
                        label: pat.title,
                        shape: 'box',
                        group: 'group_2',
                        level: '2'
                    });
                }

            }
        }
    }



    //Childs
    l = childs.length;
    if (l > 0) {
        for (var i = 0; i < l; i++) {
            if (!checkExisting(childs[i].pattern_id)) {
                pat = findPattern(childs[i].pattern_id);
                if (pat != null) {
                    nodePatterns.push({
                        id: pat.pattern_id,
                        label: pat.title,
                        shape: 'box',
                        group: 'group_4',
                        level: '4'
                    });
                    if (childs[i].relation_type == "I" || childs[i].relation_type == "E") {
                        ors.push({
                            relation: childs[i].relation_type,
                            group: childs[i].group,
                            family: "child",
                            pattern: childs[i].pattern_id
                        });
                    }
                }

            }
        }
    }
}


function linkNodes() {
    //line (default), arrow, arrow-center, or dash-line.
    //color.color	String	#848484	Color of the edge when not selected.
    //color.highlight	String	#848484	Color of the edge when selected.
    //Main Pattern to Parents
    var l = parents.length;
    if (l > 0) {
        for (var i = 0; i < l; i++) {

            var style;
            var color;
            var colorSel;
            if (parents[i].relation_type !== 'I' && parents[i].relation_type !== 'E') {

                if (parents[i].required == "N") {
                    style = "line";
                    color = "#003366"
                    colorSel = "#194775"
                } else if (parents[i].required == "M") {
                    style = "arrow";
                    color = "#000000"
                    colorSel = "#000000"
                } else if (parents[i].required == "O") {
                    style = "arrow";
                    color = "#66FF66"
                    colorSel = "#47B247"

                }
                edgePatterns.push({
                    from: parents[i].parent_id,
                    to: parents[i].pattern_id,
                    style: style,
                    color: {
                        color: color,
                        highlight: colorSel
                    }
                });
            }
        }

        //Populate parent or
        l = ors.length;
        var groupNumber = 0;
        var typeColor;
        if (l > 0) {
            for (var i = 0; i < l; i++) {
                if (ors[i].family == "parent") {
                    //Populate OR triangle
                    if (ors[i].group != groupNumber) {
                        groupNumber = ors[i].group;
                        if (ors[i].relation == "I") {
                            typeColor = "#000000"
                        } else {
                            typeColor = "#CCFFCC"
                        }
                        nodePatterns.push({
                            id: "group" + groupNumber,
                            label: "",
                            color: typeColor,
                            shape: 'triangle',
                            group: 'group_1',
                            level: '1'
                        });

                        edgePatterns.push({
                            from: patternToDraw,
                            to: "group" + groupNumber,
                            style: "line",
                            color: {
                                color: "#003366",
                                highlight: "#194775"
                            }
                        });
                    }

                    edgePatterns.push({
                        from: ors[i].pattern,
                        to: "group" + groupNumber,
                        style: "line",
                        color: {
                            color: "#003366",
                            highlight: "#194775"
                        }
                    });

                }
            }
        }

        //Populate siblings
        l = siblings.length;
        if (l > 0) {
            for (var i = 0; i < l; i++) {
                edgePatterns.push({
                    from: siblings[i].pattern_id,
                    to: "group" + groupNumber,
                    style: "line",
                    color: {
                        color: "#003366",
                        highlight: "#194775"
                    }
                });


            }
        }

    }

    //Main Pattern to Childs
    var l = childs.length;
    if (l > 0) {
        for (var i = 0; i < l; i++) {
            if (childs[i].relation_type !== 'I' && childs[i].relation_type !== 'E') {
                var style;
                var color;
                var colorSel;
                if (childs[i].required == "N") {
                    style = "line";
                    color = "#003366";
                    colorSel = "#194775";
                } else if (childs[i].required == "M") {
                    style = "arrow";
                    color = "#000000";
                    colorSel = "#000000";
                } else if (childs[i].required == "O") {
                    style = "arrow";
                    color = "#66FF66";
                    colorSel = "#47B247";

                }
                edgePatterns.push({
                    from: childs[i].parent_id,
                    to: childs[i].pattern_id,
                    style: style,
                    color: {
                        color: color,
                        highlight: colorSel
                    }
                });

            }
        }
    }

    //Populate children or
    l = ors.length;
    var groupNumber = 0;
    var typeColor;
    if (l > 0) {
        for (var i = 0; i < l; i++) {
            if (ors[i].family == "child") {
                //Populate OR triangle
                if (ors[i].group != groupNumber) {
                    groupNumber = ors[i].group;
                    if (ors[i].relation == "I") {
                        typeColor = "#000000"
                    } else {
                        typeColor = "#CCFFCC"
                    }
                    nodePatterns.push({
                        id: "group" + groupNumber,
                        label: "",
                        color: typeColor,
                        shape: 'triangle',
                        group: 'group_3',
                        level: '3'
                    });

                    edgePatterns.push({
                        from: "group" + groupNumber,
                        to: patternToDraw,
                        style: "line",
                        color: {
                            color: "#003366",
                            highlight: "#194775"
                        }
                    });
                }

                edgePatterns.push({
                    from: ors[i].pattern,
                    to: "group" + groupNumber,
                    style: "line",
                    color: {
                        color: "#003366",
                        highlight: "#194775"
                    }
                });

            }
        }
    }


}

function draw() {
    // create a network
    var container = document.getElementById('mynetwork');
    var data = {
        nodes: nodePatterns,
        edges: edgePatterns
    };
    var options = {
        stabilize: false,
        height: '400px',
        physics: {
            hierarchicalRepulsion: {
                nodeDistance: 500
            }
        },
        hierarchicalLayout: {
            levelSeparation: 100,
            nodeSpacing: 100
        }

    };
    network = new vis.Network(container, data, options);

    network.on('select', function (properties) {
        if (patternToDraw != properties.nodes && properties.nodes != "") {
            window.open('/repository/patterns/details/' + properties.nodes);
        }

        return false;
    });
}

function checkExisting(id) {
    var l = nodePatterns.length;
    if (l > 0) {
        for (var i = 0; i < l; i++) {
            if (id == nodePatterns[i].id) {
                return true;
            }
        }
    }
    return false;
}

function getParents(id) {
    $.ajax({
        url: "/repository/api/v1/trees/parents/" + id,
        type: "GET",
        cache: true,
        data: "",
        crossDomain: true,
        dataType: "json",
        success: function (result) {
            parents = result;
            try {
                if (parents[0].group != null && parents[0].group != 0) {
                    getSiblings(parents[0].group);
                }
            } catch (err) {
                console.log("No siblings!")
            }

        },
        error: function (e) {
            alert(e.responseText);
        }
    });
}

function getChilds(id) {
    $.ajax({
        url: "/repository/api/v1/trees/childs/" + id,
        type: "GET",
        cache: true,
        data: "",
        crossDomain: true,
        dataType: "json",
        success: function (result) {
            childs = result.data;
        },
        error: function (e) {
            alert(e.responseText);
        }
    });
}

function getPatterns() {
    $.ajax({
        url: "/repository/api/v1/pattern/",
        type: "GET",
        cache: true,
        data: "",
        crossDomain: true,
        dataType: "json",
        success: function (result) {
            patterns = result.data;
        },
        error: function (e) {
            alert(e.responseText);
        }
    });
}

function getSiblings(id) {
    $.ajax({
        url: "/repository/api/v1/trees/siblings/" + id,
        type: "GET",
        cache: true,
        data: "",
        crossDomain: true,
        dataType: "json",
        success: function (result) {
            siblings = result;
        },
        error: function (e) {
            alert(e.responseText);
        }
    });
}

function findPattern(id) {
    var l = patterns.length;
    if (l > 0) {
        for (var i = 0; i < l; i++) {
            if (patterns[i].pattern_id == id) {
                return patterns[i];
            }
        }
    }
    return null;
}