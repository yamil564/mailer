<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prueba
 *
 * @author User
 */
class Postcard extends Controllers
{
    public function formPostcard()
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

    public function addNewPostcard()
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
                $quantity = strClean($_POST['txtQuantity']);
                $idPostcard = $this->model->addNewPostcard($idSubsection, $mls, $picture, $title, $quantity);
                if ($idPostcard) {
                    $resultInstruccions = $this->addIntruccionsFields($idPostcard, $_POST);
                    $resultBase = $this->addBaseFields($idPostcard, $_POST);
                    $resultMultimedia = $this->addMultimediaFiles($idPostcard, $_POST, $_FILES);
                    $resultSize = $this->addSizesFields($idPostcard, $_POST);
                    if ($resultInstruccions && $resultBase && $resultMultimedia && $resultSize) {
                        $data = ['route' => base_url() . 'Postcard/allPostcard', 'message' => 'Successfully saved'];
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

    public function addIntruccionsFields($idPostcard, $lstPost)
    {
        foreach ($lstPost as $key => $value) {
            if (strpos($key, 'Instructions') !== false) {
                $lstInstructionsField[] = strClean(formatEnterTextArea($value));
            }
        }
        foreach ($lstInstructionsField as $message) {
            $response = $this->model->addIntruccionsFields($idPostcard, $message);
        }
        return $response;
    }

    public function addBaseFields($idPostcard, $lstPost)
    {
        if ($lstPost['txtBase'] == 0) {
            $response = true;
        } else {
            foreach ($lstPost as $key => $value) {
                if (strpos($key, 'base_') !== false) {
                    $lstBaseFields[] = strClean($value);
                } elseif (strpos($key, 'validate_') !== false) {
                    $lstValidateRequired[] = strClean($value);
                }
            }
            $position = 0;
            foreach ($lstBaseFields as $nameBaseField) {
                $response = $this->model->addBaseFields($idPostcard, $nameBaseField, $lstValidateRequired[$position]);
                ++$position;
            }
        }
        return $response;
    }

    public function addMultimediaFiles($idPostcard, $lstPost, $lstFiles)
    {
        $validateFile = 'FileFront';
        foreach ($lstFiles as $file) {
            $idMultimedia = $this->model->addMultimediaFiles($idPostcard, upload_file($file, 'Postcard'));
            if ($validateFile == 'FileFront') {
                $response = $this->addContentFields($idMultimedia, $lstPost, 'txtNumberFront', 'contentFront_');
            } else {
                $response = $this->addContentFields($idMultimedia, $lstPost, 'txtNumberBack', 'contentBack_');
            }
            $validateFile = 'FileBack';
        }
        return $response;
    }

    public function addContentFields($idMultimedia, $lstPost, $number, $type)
    {
        if ($lstPost[$number] == 0) {
            $response = true;
        } else {
            foreach ($lstPost as $key => $value) {
                if (strpos($key, $type) !== false) {
                    $lstContent[] = strClean($value);
                }
            }
            foreach ($lstContent as $content) {
                $response = $this->model->addContentFields($idMultimedia, $content);
            }
        }
        return $response;
    }

    public function addSizesFields($idPostcard, $lstPost)
    {
        $lstDescriptionFields = array();
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
            $response = $this->model->addSizesFields($idPostcard, $DescriptionField, $lstPriceFields[$position]);
            ++$position;
        }
        return $response;
    }

    public function allPostcard()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $listPostcards = $this->model->listPostcard();
                $this->views->getView($this, "see_all", $listPostcards);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function searchPostcard()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET) || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $idSearchPostcard = decrypted(end($url));
                $postcard = $this->model->searchPostcard($idSearchPostcard);
                $sections = $this->model->listSections();
                $subsections = $this->model->listSubsections($postcard['id_section']);
                $instruccionsFields = $this->model->searchInstruccionsFields($idSearchPostcard);
                $baseFields = $this->model->searchBaseFields($idSearchPostcard);
                $multimediaFiles = $this->model->searchMultimediaFiles($idSearchPostcard);
                $keyContent = 'contentFieldsFront';
                foreach ($multimediaFiles as $multimedia) {
                    $contentFields[$keyContent] = $this->model->searchContentFields($multimedia['id_multimedia']);
                    $keyContent = 'contentFieldsBack';
                }
                $sizeFields = $this->model->searchSizeFields($idSearchPostcard);
                if ($postcard) {
                    $this->views->getView($this, "update_postcard", [
                        'sections' => $sections, 'subsections' => $subsections, 'postcard' => $postcard,
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

    public function updatePostcard()
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
                $quantity = strClean($_POST['txtQuantity']);
                $idPostcard = decrypted($_POST['postcard']);
                $resultPostcard = $this->model->updatePostcard($idSubsection, $mls, $picture, $title, $quantity, $idPostcard);
                if ($resultPostcard) {
                    $resultInstructionsFields = $this->updateInstructionsFields($_POST);
                    $resultBaseFields = $this->updateBaseFields($_POST);
                    $resultMultimedia = $this->updateMultimediaFiles($idPostcard, $_FILES);
                    $resultContentFields = $this->updateContentFields($_POST);
                    $resultSizeFields = $this->updateSizeFields($_POST);
                    if ($resultInstructionsFields && $resultBaseFields && $resultMultimedia && $resultContentFields && $resultSizeFields) {
                        $data = [base_url() . 'Postcard/allPostcard', 'Successfully Updated'];
                        echo json_encode($data);
                    }
                } else {
                    $data = ["", 'Unsuccessfully updated'];
                    echo json_encode($data);
                }
            }
        } catch (Exception $ex) {
            $data = ['','Unexpected error, Contact administrator'];
            echo json_encode($data);
        }
    }

    public function updateInstructionsFields($lstPost)
    {
        $lstInstructionsFields = array();
        $lstIdInstructionsFieldsforUpdate = array();
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

    public function updateMultimediaFiles($idPostcard, $lstFiles)
    {
        $lstCurrentMultimediaFiles = $this->model->searchMultimediaFiles($idPostcard);
        $position = 0;
        foreach ($lstFiles as $file) {
            $routeFile = upload_file($file, 'Postcard');
            $currentRouteFile = $lstCurrentMultimediaFiles[$position]['url'];
            $currentIdMultimedia = $lstCurrentMultimediaFiles[$position]['id_multimedia'];
            $routeFile = !empty($routeFile) ? $routeFile : $currentRouteFile;
            ($routeFile != $currentRouteFile) ? delete_old_file($currentRouteFile) : "";
            $response = $this->model->updateMultimediaFiles($routeFile, $currentIdMultimedia);
            ++$position;
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
        $position = 0;
        foreach ($lstidContentsFieldsforUpdate as $idContentField) {
            $response = $this->model->updateContentFields($lstContentFields[$position], $idContentField);
            ++$position;
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

    public function deletePostcard()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $idPostcard = decrypted($_POST['postcard']);
                $response = $this->model->deletePostcard($idPostcard);
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

    public function listPostcards()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET') {
                header(HOME);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $idSubsection = end($url);
                $listPostcards = $this->model->listPostcards($idSubsection);
                if (!empty($listPostcards)) {
                   $positionPostcard = 0;
                    foreach ($listPostcards as $postcard) {
                        $lstMultimediaFields = $this->model->searchMultimediaFiles($postcard['id_postcard']);
                        $lstSizesFields = $this->model->listSizeperPostcard($postcard['id_postcard']);
                        $listPostcards[$positionPostcard]['multimediaFiles'] = $lstMultimediaFields;
                        $listPostcards[$positionPostcard]['sizesFields'] = $lstSizesFields;
                        ++$positionPostcard;
                    } 
                }
                $this->views->getView($this, "list_postcards", ['postcard' => $listPostcards]);
            }
        } catch (Exception $ex) {
            echo 'Unexpected error, Contact administrator';
        }
    }
}
