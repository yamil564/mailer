<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Unirest\Response;

/**
 * Description of prueba
 *
 * @author User
 */
class Models extends Controllers
{
    public function formModel()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
            header(LOGIN_ADMIN);
            exit();
        } else {
            $sections = $this->model->listSections();
            $subsections = $sections ? $this->model->listSubsections($sections[0]['id_section']) : [];
            $this->views->getView($this, "add_new", ['section' => $sections, 'subsections' => $subsections, 'message' => '']);
        }
    }

    public function chargeSubsectionperSections()
    {
        $idSectionSelected = $_POST['cboSection'];
        $lstSubsections = $this->model->listSubsections($idSectionSelected);
        if ($lstSubsections) {
            foreach ($lstSubsections as $subsection) {
                echo '<option value="' . $subsection["id_subsection"] . '">' . $subsection["name"] . '</option>';
            }
        }
    }

    public function addNewModel()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $mls = isset($_POST['switchmls']) ? $_POST['switchmls'] : 'off';
                $picture = isset($_POST['switchpicture']) ? $_POST['switchpicture'] : 'off';
                $title = strClean($_POST['txtTitle']);
                $idSubsection = strClean($_POST['cboSubsection']);
                $type = strClean($_POST['cboMultimedia']);
                $quantity = strClean($_POST['txtQuantity']);
                $idModel = $this->model->addNewModel($idSubsection, $mls, $picture, $title, $type, $quantity);
                if ($idModel) {
                    $resultInstruccions = $this->addIntruccionsFields($idModel, $_POST);
                    $resultBase = $this->addBaseFields($idModel, $_POST);
                    $resultMultimedia = $this->addMultimediaFiles($idModel, $_POST, $_FILES);
                    $resultSize = $this->addSizesFields($idModel, $_POST);
                    if ($resultInstruccions && $resultBase && $resultMultimedia && $resultSize) {
                        $data = ['route' => base_url() . 'Models/allModel', 'message' => 'Successfully saved'];
                    }
                } else {
                    $data = ['message' =>  'Unsuccessfully saved'];
                }
                echo json_encode($data);
            }
        } catch (Exception $ex) {
            $data = ['message' => 'Unexpected error, Contact administrator'];
            echo json_encode($data);
        }
    }

    public function addIntruccionsFields($idModel, $lstPost)
    {
        foreach ($lstPost as $key => $value) {
            if (strpos($key, 'Instructions') !== false) {
                $lstInstructionsField[] = strClean(formatEnterTextArea($value));
            }
        }
        foreach ($lstInstructionsField as $message) {
            $response = $this->model->addIntruccionsFields($idModel, $message);
        }
        return $response;
    }

    public function addBaseFields($idModel, $lstPost)
    {
        if ($lstPost['txtBase'] == 0) {
            $response = true;
        } else {
            foreach ($lstPost as $key => $value) {
                if (strpos($key, 'base_') !== false) {
                    $lstBaseFields[] = strClean($value);
                }
                if (strpos($key, 'validate_') !== false) {
                    $lstValidateRequired[] = strClean($value);
                }
            }
            $position = 0;
            foreach ($lstBaseFields as $nameBaseField) {
                $response = $this->model->addBaseFields($idModel, $nameBaseField, $lstValidateRequired[$position]);
                ++$position;
            }
        }
        return $response;
    }

    public function addMultimediaFiles($idModel, $lstPost, $lstFiles)
    {
        if (array_key_exists('txtLink', $lstPost)) {
            $idMultimedia = $this->model->addMultimediaFiles($idModel, strClean($lstPost['txtLink']));
            return $this->addContentFields($idMultimedia, $lstPost, 'txtNumberLink', 'contentLink_');
        } elseif (array_key_exists('btnVideo', $lstFiles)) {
            $idMultimedia = $this->model->addMultimediaFiles($idModel, upload_file($lstFiles['btnVideo'], 'Models'));
            return $this->addContentFields($idMultimedia, $lstPost, 'txtNumberVideo', 'contentVideo_');
        } else {
            $positionFile = 1;
            foreach ($lstFiles as $img) {
                $idMultimedia = $this->model->addMultimediaFiles($idModel, upload_file($img, 'Models'));
                $response = $this->addContentFields($idMultimedia, $lstPost, 'txtNumberPicture_' . $positionFile, 'contentPicture_' . $positionFile . '_');
                ++$positionFile;
            }
            return $response;
        }
    }

    public function addContentFields($idMultimedia, $lstPost, $number, $type)
    {
        if ($lstPost[$number] == 0) {
            $response = true;
        } else {
            foreach ($lstPost as $key => $value) {
                if (strpos($key, $type) !== false) {
                    $lstcontent[] = strClean($value);
                }
            }
            foreach ($lstcontent as $content) {
                $response = $this->model->addContentFields($idMultimedia, $content);
            }
        }
        return $response;
    }

    public function addSizesFields($idModel, $lstPost)
    {
        foreach ($lstPost as $key => $value) {
            if (strpos($key, 'txtSize_') !== false) {
                $lstDescriptionFields[] = strClean($value);
            }
            if (strpos($key, 'txtPrice_') !== false) {
                $lstPriceFields[] = strClean($value);
            }
        }
        $position = 0;
        foreach ($lstDescriptionFields as $DescriptionField) {
            $response = $this->model->addSizesFields($idModel, $DescriptionField, $lstPriceFields[$position]);
            ++$position;
        }
        return $response;
    }

    public function allModel()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $listModels = $this->model->listModels();
                $this->views->getView($this, "see_all", $listModels);
            }
        } catch (Exception $ex) {
            echo 'Unexpected error, Contact administrator';
        }
    }

    public function searchModel()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET) || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $idSearchModel = decrypted(end($url));
                $model = $this->model->searchModel($idSearchModel);
                $sections = $this->model->listSections();
                $subsections = $this->model->listSubsections($model['id_section']);
                $instruccionsFields = $this->model->searchInstruccionsFields($idSearchModel);
                $baseFields = $this->model->searchBaseFields($idSearchModel);
                $multimediaFiles = $this->model->searchMultimediaFiles($idSearchModel);
                foreach ($multimediaFiles as $multimedia) {
                    $contentFields[] = $this->model->searchContentFields($multimedia['id_multimedia']);
                }
                $sizeFields = $this->model->searchSizeFields($idSearchModel);
                if ($model) {
                    $this->views->getView($this, "update_model", [
                        'sections' => $sections, 'subsections' => $subsections, 'model' => $model,
                        'instruccionsFields' => $instruccionsFields, 'baseFields' => $baseFields,
                        'multimediaFiles' => $multimediaFiles, 'contentFields' => $contentFields,
                        'sizeFields' => $sizeFields
                    ]);
                }
            }
        } catch (Exception $ex) {
            echo 'Unexpected error, Contact administrator';
        }
    }

    public function updateModel()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $mls = isset($_POST['switchmls']) ? $_POST['switchmls'] : 'off';
                $picture = isset($_POST['switchpicture']) ? $_POST['switchpicture'] : 'off';
                $title = strClean($_POST['txtTitle']);
                $idSubsection = strClean($_POST['cboSubsection']);
                $type = strClean(decrypted($_POST['type']));
                $quantity = strClean($_POST['txtQuantity']);
                $idModel = decrypted($_POST['model']);
                $resultModel = $this->model->updateModel($idSubsection, $mls, $picture, $title, $type, $quantity, $idModel);
                if ($resultModel) {
                    $resultInstruccions = $this->updateInstructionsFields($_POST);
                    $resultBase = $this->updateBaseFields($_POST);
                    $resultMultimedia = $this->updateMultimediaFiles($_POST, $_FILES, $type, $idModel);
                    $resultContent = $this->updateContentFields($_POST);
                    $resultSizeFields = $this->updateSizeFields($_POST);
                    if ($resultInstruccions && $resultBase && $resultMultimedia && $resultContent && $resultSizeFields) {
                        $data = [base_url() . 'Models/allModel', 'Successfully Updated'];
                        echo json_encode($data);
                    }
                } else {
                    $data = ["", 'Unsuccessfully updated'];
                    echo json_encode($data);
                }
            }
        } catch (Exception $ex) {
            $data = ['', 'Unexpected error, Contact administrator'];
            echo json_encode($data);
        }
    }

    public function updateInstructionsFields($lstPost)
    {
        foreach ($lstPost as $key => $value) {
            if (strpos($key, 'Instructions_') !== false) {
                $idInstructionsField = explode('_', $key);
                $lstIdInstructionsFieldsforUpdate[] = end($idInstructionsField);
                $lstInstructionsFields[] = strClean(formatEnterTextArea($value));
            }
        }
        $position = 0;
        foreach ($lstIdInstructionsFieldsforUpdate as $idInstructionsField) {
            $response = $this->model->updateInstructionsFields($lstInstructionsFields[$position], $idInstructionsField);
            ++$position;
        }
        return $response;
    }

    public function updateBaseFields($lstPost)
    {
        foreach ($lstPost as $key => $value) {
            if (strpos($key, 'base_') !== false) {
                $idBaseField = explode('_', $key);
                $lstIdBaseFieldsforUpdate[] = end($idBaseField);
                $lstBaseFields[] = strClean($value);
            }
            if (strpos($key, 'validate_') !== false) {
                $lstValidateRequired[] = strClean($value);
            }
        }
        if (isset($lstIdBaseFieldsforUpdate) && isset($lstBaseFields) && isset($lstValidateRequired)) {
            $position = 0;
            foreach ($lstIdBaseFieldsforUpdate as $idBaseField) {
                $response = $this->model->updateBaseFields($lstBaseFields[$position], $lstValidateRequired[$position], $idBaseField);
                ++$position;
            }
        } else {
            $response = true;
        }
        return $response;
    }

    public function updateMultimediaFiles($lstPost, $lstFiles, $type, $idModel)
    {
        $lstCurrentMultimediaFiles = $this->model->searchMultimediaFiles($idModel);
        if ($type == 'link') {
            foreach ($lstPost as $key => $value) {
                if (strpos($key, 'txtLink_') !== false) {
                    $idLink = explode('_', $key);
                    $routeFile = $value;
                }
            }
            $routeFile = ($routeFile != $lstCurrentMultimediaFiles[0]['url']) ? $routeFile : $lstCurrentMultimediaFiles[0]['url'];
            $response = $this->model->updateMultimediaFiles($routeFile, end($idLink));
        } elseif ($type == 'video') {
            $idVideo = explode('_', key($lstFiles));
            $routeFile = upload_file($lstFiles[key($lstFiles)], 'Models');
            $routeFile = !empty($routeFile) ? $routeFile : $lstCurrentMultimediaFiles[0]['url'];
            ($routeFile != $lstCurrentMultimediaFiles[0]['url']) ? delete_old_file($lstCurrentMultimediaFiles[0]['url']) : '';
            $response = $this->model->updateMultimediaFiles($routeFile, end($idVideo));
        } else {
            $position = 0;
            foreach ($lstFiles as $key => $value) {
                $idImage = explode('_', $key);
                $routeFile = upload_file($value, 'Models');
                $routeFile = !empty($routeFile) ? $routeFile : $lstCurrentMultimediaFiles[$position]['url'];
                ($routeFile != $lstCurrentMultimediaFiles[$position]['url']) ? delete_old_file($lstCurrentMultimediaFiles[$position]['url']) : '';
                $response = $this->model->updateMultimediaFiles($routeFile, end($idImage));
                ++$position;
            }
        }
        return $response;
    }

    public function updateContentFields($lstPost)
    {
        foreach ($lstPost as $key => $value) {
            if (strpos($key, 'content_') !== false) {
                $idContentField = explode('_', $key);
                $lstidContentsFieldsforUpdate[] = end($idContentField);
                $lstContentFields[] = strClean($value);
            }
        }
        if (isset($lstidContentsFieldsforUpdate) && isset($lstContentFields)) {
            $position = 0;
            foreach ($lstidContentsFieldsforUpdate as $idContentField) {
                $response = $this->model->updateContentFields($lstContentFields[$position], $idContentField);
                ++$position;
            }
        } else {
            $response = true;
        }
        return $response;
    }

    public function updateSizeFields($lstPost)
    {
        foreach ($lstPost as $key => $value) {
            if (strpos($key, 'txtSize_') !== false) {
                $idSizeField = explode('_', $key);
                $lstIdSizeFieldsforUpdate[] = end($idSizeField);
                $lstDescriptionFields[] = strClean($value);
            }
            if (strpos($key, 'txtPrice_') !== false) {
                $lstPriceFields[] = strClean($value);
            }
        }
        $position = 0;
        foreach ($lstIdSizeFieldsforUpdate as $idSizeField) {
            $response = $this->model->updateSizeFields($lstDescriptionFields[$position], $lstPriceFields[$position], $idSizeField);
            ++$position;
        }
        return $response;
    }

    public function deleteModel()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $idModel = decrypted($_POST['model']);
                $response = $this->model->deleteModel($idModel);
                if ($response) {
                    echo 'Successfully removed';
                } else {
                    echo 'Unsuccessfully deleted';
                }
            }
        } catch (Exception $ex) {
            echo 'Unexpected error, Contact administrator';
        }
    }

    public function listModel()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['client'])) {
                header(HOME);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $idSubsection = end($url);
                $listModels = $this->model->listModel($idSubsection);
                $positionModel = 0;
                foreach ($listModels as $model) {
                    $lstMultimediaFields = $this->model->searchMultimediaFiles($model['id_model']);
                    $lstSizesFields = $this->model->listSizeperModel($model['id_model']);
                    $listModels[$positionModel]['multimediaFiles'] = $lstMultimediaFields;
                    $listModels[$positionModel]['sizesFields'] = $lstSizesFields;
                    ++$positionModel;
                }
                if ($listModels && $lstMultimediaFields && $lstSizesFields) {
                    $this->views->getView($this, "list_models", ['model' => $listModels]);
                } else {
                    $this->views->getView($this, "list_models", "Models not avaible");
                }
            }
        } catch (Exception $ex) {
            echo 'Unexpected error, Contact administrator';
        }
    }
}
