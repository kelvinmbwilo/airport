/**
 * Created by kelvin on 4/12/15.
 */
/**
 * Created by kelvin on 4/12/15.
 */

angular.module("airportApp")
    .controller("homeCtrl",function($scope,$http,$interval){

        $scope.ddata = {};
        $scope.ddata.departure = [];
        $scope.ddata.arrival = [];
        $scope.time = new Date();
        $http.get("timetable.php?page=fetch").success(function(data){
            $scope.users = data;
            angular.forEach($scope.users,function(value){
               if(value.type == " Departure"){
                   $scope.ddata.departure.push(value);
               }
                if(value.type == " Arrival"){
                    $scope.ddata.arrival.push(value);
                }
            });
        });
        $http.get("flights.php?page=fetch").success(function(data){
            $scope.flights = data;
        });
        $http.get("destinations.php?page=fetch").success(function(data){
            $scope.destinations = data;
        });
        $interval( function(){
            $scope.ddata = {};
            $scope.ddata.departure = [];
            $scope.ddata.arrival = [];
            $scope.time = new Date();
            $http.get("timetable.php?page=fetch").success(function(data){
                $scope.users = data;
                angular.forEach($scope.users,function(value){
                    if(value.type == " Departure"){
                        $scope.ddata.departure.push(value);
                    }
                    if(value.type == " Arrival"){
                        $scope.ddata.arrival.push(value);
                    }
                });
            });

            $http.get("flights.php?page=fetch").success(function(data){
                $scope.flights = data;
            });
            $http.get("destinations.php?page=fetch").success(function(data){
                $scope.destinations = data;
            });
        }, 5000);


        $scope.compareTime = function(date,time){
             var date1 = $scope.time.getFullYear()+"-"+$scope.time.getMonth()+"-"+$scope.time.getDay();
            var date2 = new Date(date).getFullYear()+"-"+new Date(date).getMonth()+"-"+new Date(date).getDay();
            var time1 = $scope.time.getHours()+":"+$scope.time.getMinutes();
            var time2 = new Date(time).getHours()+":"+new Date(time).getMinutes();
            var start =  moment(date1+" "+time1);
            var end =  moment(date2+" "+time2);
            var duration = moment.duration(end.diff(start));
            var hours = duration.asHours();
            console.log("dfgfdhghdgdh")
            if(hours >= 1){
                  return true;
            }else{
                return false;
            }
        }

    }).controller("homeCtrl1",function($scope,$http,$interval){


        $scope.time = new Date();
        $scope.time1 = new Date();


        $scope.getDate = function(){
            $interval( function(){
                $scope.time1 = new Date();
            },1000);
        }
        $scope.getDate();

        $scope.ddata = {};
        $scope.ddata.departure = [];
        $scope.ddata.arrival = [];
        $scope.ddata.users = [];
        $scope.time = new Date();
        $http.get("admin/timetable.php?page=fetch").success(function(data){
            $scope.users = data;
            var i = 1;
            var j = 1;
            angular.forEach($scope.users,function(value){
                if($scope.checkDate(value.date,value.usetime)){
                    value.show=true;
                    if(value.type === "Departure"){
                        value.number = i;
                        i++;
                        $scope.ddata.departure.push(value);
                    }
                    if(value.type === "Arrival"){
                        value.number = j;
                        j++;
                        $scope.ddata.arrival.push(value);
                    }
                }else{
                    value.show = false;
                }
            });
        });

        $http.get("admin/flights.php?page=fetch").success(function(data){
            $scope.flights = data;
        });
        $http.get("admin/destinations.php?page=fetch").success(function(data){
            $scope.destinations = data;
        });
        $interval( function(){
            $http.get("admin/timetable.php?page=fetch").success(function(data){
                $scope.users = data;
                var i = 1;
                var j = 1;
                $scope.ddata.departure = [];
                $scope.ddata.arrival = [];
                angular.forEach($scope.users,function(value){
                    if($scope.checkDate(value.date,value.usetime)){
                        value.show=true;
                        if(value.type === "Departure"){
                            value.number = i;
                            i++;
//                            if($scope.checkIfAvailable($scope.ddata.departure,value.id)
                            $scope.ddata.departure.push(value);
                        }
                        if(value.type === "Arrival"){
                            value.number = j;
                            j++;
                            $scope.ddata.arrival.push(value);
                        }
                    }else{
                        value.show = false;
                    }
                });
            });

            $http.get("admin/flights.php?page=fetch").success(function(data){
                $scope.flights = data;
            });
            $http.get("admin/destinations.php?page=fetch").success(function(data){
                $scope.destinations = data;
            });
        }, 15000);

            $scope.checkIfAvailable = function(object1,value){
                var id = value;
                var status = false;
                angular.forEach(object1,function(value1){
                    if(value1.id == id){
                        status = true;
                    }
                });
                return status;
            }
            
        $scope.checkDate = function (date,time){
            var month = new Date(date).getMonth() + 1;
            var date2 = new Date(date).getFullYear()+"-"+month+"-"+new Date(date).getDate();
            var time2 = new Date(time).getHours()+":"+new Date(time).getMinutes();
            var time3 = new Date(date2+" "+time2)
            var end =  moment(time3);
            var now = moment();
            var duration = moment.duration(end.diff(now));
            var hours = duration.asMinutes();
            console.log(end.isAfter(now)+ " -- "+ date2 +" diff is "+ hours)
            if(end.isAfter(now) && hours >= 0 && hours <= 1000){
                  return true;
            }else{
                return false;
            }
        }

        $scope.showThis = function(number,max){
            if(max > 8){
                if(number > $scope.toshow){
                    return true;
                }else{
                    return false;
                }
            }else{
                return true;
            }
        }

        $scope.toshow = 0;
        $interval( function(){
            if($scope.toshow == 8){
                $scope.toshow = 0;
            }else{
                $scope.toshow+=8;
            }
        },15000);

        $scope.compareTime = function(date,time){
            var date1 = $scope.time.getFullYear()+"-"+$scope.time.getMonth()+"-"+$scope.time.getDay();
            var date2 = new Date(date).getFullYear()+"-"+new Date(date).getMonth()+"-"+new Date(date).getDay();
            var time1 = $scope.time.getHours()+":"+$scope.time.getMinutes();
            var time2 = new Date(time).getHours()+":"+new Date(time).getMinutes();
            var start =  moment(date1+" "+time1);
            var end =  moment(date2+" "+time2);
            var duration = moment.duration(end.diff(start));
            var hours = duration.asHours();
            console.log("dfgfdhghdgdh")
            if(hours >= 1){
                  return true;
            }else{
                return false;
            }
        }

    });


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
