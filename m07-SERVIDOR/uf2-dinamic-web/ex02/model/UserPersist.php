<?php
require_once './User.php';
class UserFilePersist
{
    public function __construct(private ?string $filename, private ?string $delimiter)
    {
        $this->filename = $filename;
        $this->delimiter = $delimiter;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }
    /**
     * reads all users from file 
     * @return array an array with all users read from fileo or empty array if fails
     */
    public function readAllUsers(): array
    {
        $result = [];
        if (file_exists($this->filename) && (is_writeable($this->filename))) {
            $handle = fopen($this->filename, 'r');
            // if open success
            if ($handle !== false) {
                do {
                    //$fields = fgetcsv($handle, 1000, $this->delimiter);
                    $line = fscanf($handle, "%s\n");
                    $fields = explode($this->delimiter, $line);
                    if (count($fields ) ==2) {
                        $uname = $fields[0];
                        $pword = $fields[1];
                        $user = new User($uname, $pword);
                        array_push($result, $user);
                    }
                } while (!feof($handle));
            } else {
                $result = array();
            }
            fclose($handle);
        }
        return $result; 
    }

    public function addUser(User $user): bool
    {
        $result = false;
        if (file_exists($this->filename) && (is_writeable($this->filename))) {
            $handle = fopen($this->filename, 'a');
            // if open success
            if ($handle !== false) {
                fprintf(
                    $handle,
                    "%s%s%s\n",
                    $user->getUsername(),
                    $this->delimiter,
                    $user->getPassword()
                );
                $result = true;
                fclose($handle);
            }
        } else {
            $result = false;
        }
        return $result;
    }
}
