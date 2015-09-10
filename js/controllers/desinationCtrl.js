/**
 * Created by kelvin on 4/12/15.
 */
angular.module("airportApp")
    .controller("destinationCtrl",function($scope,$http,$mdDialog,$mdToast,$animate){
        $scope.currentKaya = {};
        $scope.currentSaving = false;
        $scope.currentUpdating = false;
        $scope.currentEditting = false;
        $scope.kayaSavedSuccess = false;
        $scope.kayaUpdatedSuccess = false;
        $scope.kayaSavedFalue = false;
        $scope.kayaUpdateFalue = false;
        $scope.showEditAdd = false;

        $http.get("destinations.php?page=fetch").success(function(data){
            $scope.users = data;
        });

        $scope.saveUser = function(user){
            $scope.currentSaving = true;
            $http.post("destinations.php?page=save", user).success(function (newUser) {
                $scope.users = newUser;
                $scope.currentKaya = {};
                $scope.kayaSavedSuccess = true;
                $scope.currentSaving = false;
                $scope.kayaSavedFalue = false;
                $scope.repassword = "";
                $mdToast.show(
                    $mdToast.simple()
                        .content('Destination Created Successfully!')
                        .position($scope.getToastPosition())
                        .hideDelay(3000)
                );
                $scope.showEditAdd = false;
            }).error(function(){
                $scope.kayaSavedSuccess = false;
                $scope.currentSaving = false;
                $scope.kayaSavedFalue = true;
            });
        }

        $scope.showAEdit = function(user){
            $scope.showEditAdd = true;
            $scope.currentEditting = true;
            $scope.currentKaya = user;
        }

        $scope.showAdd = function(){
            $scope.showEditAdd = true;
            $scope.currentEditting = false;
            $scope.currentKaya = {};
        }

        $scope.cancelEditting = function(){
            $scope.showEditAdd = false;
            $scope.currentEditting = false;
            $scope.currentKaya = {};
        }

        $scope.cancelAdding = function(){
            $scope.showEditAdd = false;
            $scope.currentKaya = {};
        }

        $scope.updateUser = function(user){
            $scope.currentUpdating = true;
            $http.post("destinations.php?page=update", user).success(function (newUser) {
                for (var i = 0; i < $scope.users.length; i++) {
                    if ($scope.users[i].id == newUser.id) {
                        $scope.users[i] = newUser;
                        break;
                    }
                }
                $mdToast.show(
                    $mdToast.simple()
                        .content('Destination Updated Successfully!')
                        .position($scope.getToastPosition())
                        .hideDelay(3000)
                );
                $scope.showEditAdd = false;
                $scope.kayaUpdatedSuccess = true;
                $scope.currentUpdating = false;
                $scope.kayaUpdateFalue = false;
            }).error(function(){
                $scope.kayaUpdatedSuccess = false;
                $scope.currentUpdating = false;
                $scope.kayaUpdateFalue = true;
            })

        }
        $scope.toastPosition = {
            bottom: true,
            top: false,
            left: false,
            right: true
        };

        $scope.getToastPosition = function() {
            return Object.keys($scope.toastPosition)
                .filter(function(pos) { return $scope.toastPosition[pos]; })
                .join(' ');
        };

        $scope.deletedUser = [];
        $scope.deletingdUser = [];
        $scope.showConfirm = function(ev,id) {
            var confirm = $mdDialog.confirm()
                .title('Are you sure you want to delete this Destination')
                .content('This action is irreversible')
                .ariaLabel('Lucky day')
                .ok('Delete')
                .cancel('Cancel')
                .targetEvent(ev);
            $mdDialog.show(confirm).then(function() {
                $scope.deletingdUser[id] = true;
                $http.post("destinations.php?page=delete",{id:id}).success(function (newVal) {
                    $scope.deletedUser[id] = true;
                    $mdToast.show(
                        $mdToast.simple()
                            .content('Destination Deleted Successfully!')
                            .position($scope.getToastPosition())
                            .hideDelay(3000)
                    );
                });
            }, function() {

            });
        };
        $scope.passcheck = false;
        $scope.passwordNoMatch = function(){
            if($scope.currentKaya.password){
                if($scope.currentKaya.password != "" && $scope.repassword && $scope.repassword != ""){
                    if($scope.currentKaya.password == $scope.repassword){
                        $scope.passcheck = false;
                    }else{
                        $scope.passcheck = true;
                    }
                }else{
                    $scope.passcheck = false;
                }
            }
        }

    });

function DialogController($scope, $mdDialog) {
    $scope.hide = function() {
        $mdDialog.hide();
    };
    $scope.cancel = function() {
        $mdDialog.cancel();
    };
    $scope.answer = function(answer) {
        $mdDialog.hide(answer);
    };
}