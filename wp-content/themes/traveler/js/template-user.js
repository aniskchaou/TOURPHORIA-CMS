var me = jQuery("span.all_time.user_dashboard");
if (me.length > 0) {
    var data_lable_year = me.data("data_lable_year"), data_sets_year = me.data("data_sets_year");
    // if (data_lable_year && data_sets_year) {
    //     var lineChartData_total_year = {
    //         labels: data_lable_year,
    //         type: "area",
    //         datasets: [{
    //             fillColor: "rgba(81,145,250,0.05)",
    //             strokeColor: "rgba(81,145,250, 0.8)",
    //             pointColor: "rgba(81,145,250, 0.75)",
    //             pointStrokeColor: "#fff",
    //             pointHighlightFill: "#fff",
    //             pointHighlightStroke: "rgba(81,145,250, 1)",
    //             type: "area",
    //             data: data_sets_year
    //         }]
    //     };
    //     jQuery(function () {
    //         var a = document.getElementById("canvas_year_new").getContext("2d");
    //         new Chart(a).Line(lineChartData_total_year, {bezierCurve : false,responsive: !0, animationEasing: "easeOutBounce"})
    //     })
    // }
     window.onload = function() {
        var a = document.getElementById("canvas_year_new").getContext("2d");
        var stChart_month = new Chart(a, {
            type: 'line',
            data: {
                labels: data_lable_year,
                datasets: [{
                    data: data_sets_year,
                    lineTension:0,
                    borderColor: "rgba(81,145,250, 1)",
                    backgroundColor: "rgba(81,145,250, 0.4)",
                    pointBackgroundColor: "rgba(81,145,250, 1)",
                    pointBorderColor: "rgba(81,145,250, 1)",
                    pointHoverBackgroundColor: "rgba(81,145,250, 1)",
                    pointHoverBorderColor: "rgba(81,145,250, 1)",
                    borderWidth: 2
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    };
}
var me = jQuery("span.this_month.user_dashboard");
if (me.length > 0) {
    var data_lable = me.data("data_lable"), data_sets = me.data("data_sets");
    var canvas_month = document.getElementById("canvas_month").getContext("2d");
    var stChart_month = new Chart(canvas_month, {
        type: 'line',
        data: {
            labels: data_lable,
            datasets: [{
                data: data_sets,
                lineTension:0,
                borderColor: "rgba(81,145,250, 1)",
                backgroundColor: "rgba(81,145,250, 0.4)",
                pointBackgroundColor: "rgba(81,145,250, 1)",
                pointBorderColor: "rgba(81,145,250, 1)",
                pointHoverBackgroundColor: "rgba(81,145,250, 1)",
                pointHoverBorderColor: "rgba(81,145,250, 1)",
                borderWidth: 2
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}
var me = jQuery("span.year.user_dashboard");
if (me.length > 0) {
    var data_lable_year = me.data("data_lable_year"), data_sets_year = me.data("data_sets_year");
    if (data_lable_year && data_sets_year) {
        // var lineChartData_total_year = {
        //     labels: data_lable_year,
        //     datasets: [{
        //         fillColor: "rgba(81,145,250,0.05)",
        //         strokeColor: "rgba(81,145,250, 0.8)",
        //         pointColor: "rgba(81,145,250, 0.75)",
        //         pointStrokeColor: "#fff",
        //         pointHighlightFill: "#fff",
        //         pointHighlightStroke: "rgba(81,145,250, 1)",
        //         data: data_sets_year
        //     }]
        // };


            jQuery(document).on("click", ".btn_all_time", function () {
                setTimeout(function () {
                    var canvas_year = document.getElementById("canvas_year").getContext("2d");
                    var stChart_year = new Chart(canvas_year, {
                        type: 'line',
                        data: {
                            labels: data_lable_year,
                            datasets: [{
                                data: data_sets_year,
                                lineTension:0,
                                borderColor: "rgba(81,145,250, 1)",
                                backgroundColor: "rgba(81,145,250, 0.4)",
                                pointBackgroundColor: "rgba(81,145,250, 1)",
                                pointBorderColor: "rgba(81,145,250, 1)",
                                pointHoverBackgroundColor: "rgba(81,145,250, 1)",
                                pointHoverBorderColor: "rgba(81,145,250, 1)",
                                borderWidth: 2
                            }]
                        },
                        options: {
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });

                    // var a = document.getElementById("canvas_year").getContext("2d");
                    // new Chart(a).Line(lineChartData_total_year, {bezierCurve : false,responsive: !0, animationEasing: "easeOutBounce"})


                }, 500), a(".div_custom_month").hide()
            })

    }
}
var me = jQuery("span.else.user_dashboard");
if (me.length > 0) {
    var data_lable = me.data("data_lable"), data_sets = me.data("data_sets");
    if (data_lable && data_sets) {
        var lineChartData_total = {
            labels: data_lable,
            datasets: [{
                fillColor: "rgba(81,145,250,0.05)",
                strokeColor: "rgba(81,145,250, 0.8)",
                pointColor: "rgba(81,145,250, 0.75)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(81,145,250, 1)",
                data: data_sets
            }]
        };
        jQuery(function () {
            var a = document.getElementById("canvas_month").getContext("2d");
            var stChart = new Chart(a, {
                type: 'line',
                data: {
                    labels: data_lable,
                    datasets: [{
                        data: data_sets,
                        lineTension:0,
                        borderColor: "rgba(81,145,250, 1)",
                        backgroundColor: "rgba(81,145,250, 0.4)",
                        pointHoverBackgroundColor: "rgba(81,145,250, 1)",
                        pointBorderColor: "rgba(81,145,250, 1)",
                        pointHoverBackgroundColor: "rgba(81,145,250, 1)",
                        pointHoverBorderColor: "rgba(81,145,250, 1)",
                        borderWidth: 2
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            //new Chart(a).Line(lineChartData_total, {bezierCurve : false,responsive: !0, animationEasing: "easeOutBounce"})
        })
    }
}
var me = jQuery("span.st_user_dashboard_info.lineChartData_total");
if (me.length > 0) {
    var data_lable = me.data("data_label"), data_sets = me.data("data_sets"), lineChartData_total = {
        labels: data_lable,
        datasets: [{
            label: "",
            fillColor: "rgba(81,145,250,0.05)",
            strokeColor: "rgba(81,145,250, 0.8)",
            pointColor: "rgba(81,145,250, 0.75)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(81,145,250, 1)",
            data: data_sets
        }]
    };
    jQuery(function (a) {
        var t = document.getElementById("canvas_this_month").getContext("2d");
        var stChart = new Chart(t, {
            type: 'line',
            data: {
                labels: data_lable,
                datasets: [{
                    data: data_sets,
                    lineTension:0,
                    borderColor: "rgba(81,145,250, 1)",
                    backgroundColor: "rgba(81,145,250, 0.4)",
                    pointBackgroundColor: "rgba(81,145,250, 1)",
                    pointBorderColor: "rgba(81,145,250, 1)",
                    pointHoverBackgroundColor: "rgba(81,145,250, 1)",
                    pointHoverBorderColor: "rgba(81,145,250, 1)",
                    borderWidth: 2
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        //new Chart(t).Line(lineChartData_total, {bezierCurve : false,responsive: !0, animationEasing: "easeOutBounce"})
    })
}
var me = jQuery("span.st_user_dashboard_info.lineChartData_total_year");
if (me.length > 0) {
    var data_lable_year = me.data("data_lable_year"), data_sets_year = me.data("data_sets_year");
    if (data_lable_year && data_sets_year) {
        var lineChartData_total_year = {
            labels: data_lable_year,
            datasets: [{
                fillColor: "rgba(81,145,250,0.05)",
                strokeColor: "rgba(81,145,250, 0.8)",
                pointColor: "rgba(81,145,250, 0.75)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(81,145,250, 1)",
                data: data_sets_year
            }]
        };
        jQuery(function (a) {
            a(document).on("click", ".btn_single_all_time", function () {
                setTimeout(function () {
                    var a = document.getElementById("canvas_year").getContext("2d");
                    var stChart_year = new Chart(a, {
                        type: 'line',
                        data: {
                            labels: data_lable_year,
                            datasets: [{
                                data: data_sets_year,
                                lineTension:0,
                                borderColor: "rgba(81,145,250, 1)",
                                backgroundColor: "rgba(81,145,250, 0.4)",
                                pointBackgroundColor: "rgba(81,145,250, 1)",
                                pointBorderColor: "rgba(81,145,250, 1)",
                                pointHoverBackgroundColor: "rgba(81,145,250, 1)",
                                pointHoverBorderColor: "rgba(81,145,250, 1)",
                                borderWidth: 2
                            }]
                        },
                        options: {
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    })
                    // new Chart(a).Line(lineChartData_total_year, {bezierCurve : false,responsive: !0, animationEasing: "easeOutBounce"})
                }, 500), a(".div_single_custom").hide()
            })
        })
    }
}
jQuery(function (a) {
    var t = a("#type_price").val();
    "activity_price" == t ? (a(".activity_price").show(500), a(".people_price").hide(500)) : (a(".activity_price").hide(500)), a("#type_price").change(function () {
        var t = a(this).val();
        "activity_price" == t ? (a(".activity_price").show(500), a(".people_price").hide(500)) : (a(".activity_price").hide(500), a(".people_price").show(500))
    });
    var e = a("#type_activity").val();
    "specific_date" == e ? (a(".data_activity_specific_date").show(500), a(".data_duration").hide(500)) : (a(".data_activity_specific_date").hide(500), a(".data_duration").show(500)), a("#type_activity").change(function () {
        var t = a(this).val();
        "specific_date" == t ? (a(".data_activity_specific_date").show(500), a(".data_duration").hide(500)) : (a(".data_activity_specific_date").hide(500), a(".data_duration").show(500))
    })
}), jQuery(function (a) {
    var t = a("#type_price").val();
    "tour_price" == t ? (a(".tour_price").show(500), a(".people_price").hide(500)) : (a(".tour_price").hide(500)), a("#type_price").change(function () {
        var t = a(this).val();
        "tour_price" == t ? (a(".tour_price").show(500), a(".people_price").hide(500)) : (a(".tour_price").hide(500), a(".people_price").show(500))
    });
    var e = a("#tour_type").val();
    "specific_date" == e ? (a(".data_specific_date").show(500), a(".data_duration").hide(500)) : (a(".data_specific_date").hide(500), a(".data_duration").show(500)), a("#type_tour").change(function () {
        var t = a(this).val();
        "specific_date" == t ? (a(".data_specific_date").show(500), a(".data_duration").hide(500)) : (a(".data_specific_date").hide(500), a(".data_duration").show(500))
    })
}), jQuery(function (a) {
    if (a(".single_partner_contact .info_map").length) {
        var t = a(".single_partner_contact .info_map").data("lat"),
            e = a(".single_partner_contact .info_map").data("lng"),
            i = a(".single_partner_contact .info_map").data("zoom"),
            r = a(".single_partner_contact .info_map").data("icon");
        a(".single_partner_contact .info_map").gmap3({
            map: {options: {center: [t, e], zoom: i}},
            marker: {values: [{latLng: [t, e], options: {icon: r}}]}
        })
    }
}), jQuery(function (a) {
    var t = a("#type_price").val();
    "activity_price" == t ? (a(".activity_price").show(500), a(".people_price").hide(500)) : (a(".activity_price").hide(500)), a("#type_price").change(function () {
        var t = a(this).val();
        "activity_price" == t ? (a(".activity_price").show(500), a(".people_price").hide(500)) : (a(".activity_price").hide(500), a(".people_price").show(500))
    });
    var e = a("#type_activity").val();
    "specific_date" == e ? (a(".data_activity_specific_date").show(500), a(".data_duration").hide(500)) : (a(".data_activity_specific_date").hide(500), a(".data_duration").show(500)), a("#type_activity").change(function () {
        var t = a(this).val();
        "specific_date" == t ? (a(".data_activity_specific_date").show(500), a(".data_duration").hide(500)) : (a(".data_activity_specific_date").hide(500), a(".data_duration").show(500))
    })
}), jQuery(function (a) {
    var t = a("#type_price").val();
    "tour_price" == t ? (a(".tour_price").show(500), a(".people_price").hide(500)) : (a(".tour_price").hide(500)), a("#type_price").change(function () {
        var t = a(this).val();
        "tour_price" == t ? (a(".tour_price").show(500), a(".people_price").hide(500)) : (a(".tour_price").hide(500), a(".people_price").show(500))
    });
    var e = a("#tour_type").val();
    "specific_date" == e ? (a(".data_specific_date").show(500), a(".data_duration").hide(500)) : (a(".data_specific_date").hide(500), a(".data_duration").show(500)), a("#tour_type").change(function () {
        var t = a(this).val();
        "specific_date" == t ? (a(".data_specific_date").show(500), a(".data_duration").hide(500)) : (a(".data_specific_date").hide(500), a(".data_duration").show(500))
    })
}), jQuery(function (a) {
    function t(a, t, e, i) {
        var r = new google.maps.Marker({
            position: a,
            options: {icon: e[2], animation: google.maps.Animation.DROP},
            data: e
        });
        return r
    }

    if (a(".st_google_map_user").length > 0) {
        var e = a(".st_user_overview").data("overview");
        console.log(e);
        var i = a(".st_google_map_user").gmap3({map: {options: {zoom: 5}}}), r = i.gmap3("get"),
            o = new google.maps.LatLngBounds, _ = [];
        for (var n in e) {
            var s = e[n], l = new google.maps.LatLng(s[0], s[1]);
            o.extend(l);
            var d = t(l, r, s, i);
            _.push(d)
        }
        var c = {
            gridSize: 50,
            styles: [{height: 53, url: st_list_map_params.cluster_m1, width: 53}, {
                height: 56,
                url: st_list_map_params.cluster_m2,
                width: 56
            }, {height: 66, url: st_list_map_params.cluster_m3, width: 66}, {
                height: 78,
                url: st_list_map_params.cluster_m4,
                width: 78
            }, {height: 90, url: st_list_map_params.cluster_m5, width: 90}]
        };
        new MarkerClusterer(r, _, c), r.fitBounds(o)
    }
});

(function($){
    'use strict';
    var partnerPage = $('.page-template-template-user-php');

    $('#btn_add_tours_faq', partnerPage).click(function () {
        var html = $('#html_tours_faq').html();
        $('#data_tours_faq').append(html)
    });

    $(document).on('click', '.btn_del_tours_faq', function () {
        $(this).parent().parent().parent().remove()
    });

    $('#btn_add_activity_faq', partnerPage).click(function () {
        var html = $('#html_activity_faq').html();
        $('#data_activity_faq').append(html)
    });

    $(document).on('click', '.btn_del_activity_faq', function () {
        $(this).parent().parent().parent().remove()
    });
})(jQuery);