<?php
interface iFile
{
    public function __construct($filePath);

    public function getPath(); // путь к файлу
    public function getDir();  // папка файла
    public function getName(); // имя файла
    public function getExt();  // расширение файла
    public function getSize(); // размер файла

    public function getText();          // получает текст файла
    public function setText($text);     // устанавливает текст файла
    public function appendText($text);  // добавляет текст в конец файла

    public function copy($copyPath);    // копирует файл
    public function delete();           // удаляет файл
    public function rename($newName);   // переименовывает файл
    public function replace($newPath);  // перемещает файл
}
class File implements iFile
{
    public $filePath;
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }
    public function getPath()
    {

        return $this->filePath;
    }
    public function getDir()
    {
        $arr = explode('/', $this->filePath);
        return $arr[count($arr) - 2];
    }
    public function getName()
    {
        $arr1 = explode('.', $this->filePath);
        if (count($arr1) > 1) {
            $arr3 = explode('/', $arr1[count($arr1) - 2]);
            if (count($arr3) > 1) {
                return $arr3[count($arr3) - 1];
            } else {
                return $arr1[count($arr1) - 2];
            }
        }
    }
    public function getExt()
    {
        $arr1 = explode('.', $this->filePath);
        if (count($arr1) > 1) {
            $arr3 = explode('/', $arr1[count($arr1) - 2]);
            if (count($arr3) > 1) {
                return $arr3[count($arr3) - 2];
            }
        }
    }
    public function getSize()
    {
        filesize($this->filePath);
    }
    public function getText()
    {
        file_get_contents($this->filePath);
    }
    public function setText($text)
    {
        file_put_contents($this->filePath, $text);
    }
    public function appendText($text)
    {
        $tx = file_get_contents($this->filePath);
        file_put_contents($this->filePath, $tx . $text);
    }
    public function copy($copyPath)
    {
        copy($this->filePath, $copyPath);
    }
    public function delete()
    {
        unlink($this->filePath);
    }
    public function rename($newName)
    {
        rename($this->getName(), $newName);
    }
    public function replace($newPath)
    {
        rename($newPath, $newPath);
    }
}
$ob = new File('eeee/fffjfj/ffffvvvv/vbn/test.php');
echo $ob->getExt();
