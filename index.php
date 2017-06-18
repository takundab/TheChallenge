<?php
class Jobs
{
    private $jobOutput = array();
    private $jobarray = array();

    public function getJobs($jobData)
    {
        if (empty($jobData)) {
            return "Empty sequence.";
        }
        $jobs = explode("\n", str_replace(" ", '', $jobData)); //convert job data into key value array
        foreach ($jobs as $job) {
            $value = explode("=>", $job);
            $this->jobarray[trim($value[0])] = trim($value[1]);
        }
        if ($this->checkDependencies($this->jobarray) === true) { //check if array has the same value for key and value
            return "Jobs can’t depend on themselves.";
        }
        foreach ($this->jobarray as $key => $value) {  //check if key value pair exists (if exists - run jobSequen ELSE put key in array)
            if (empty($value)) {
                if (!in_array($key, $this->jobOutput)) {
                    array_push($this->jobOutput, $key);
                }
            } else {
                $this->jobSequence($key, $value);
            }
        }
        return implode('', $this->jobOutput);
    }

    private function jobSequence($key, $value)
    {
        $position = 0;
        if (in_array($key, $this->jobOutput) && in_array($value, $this->jobOutput)) { //check circular dependencies
            die("jobs can not have circular dependencies");
        } elseif (in_array($value, $this->jobOutput)) { //check if value exists inside the array then put key after the value if exists
            $position = array_search($value, $this->jobOutput) + 1;
            $inserted = array($key);
            array_splice($this->jobOutput, $position, 0, $inserted);
        } elseif (in_array($key, $this->jobOutput)) {  //check if key exists inside the array then put value before the value if exists
            $position = array_search($key, $this->jobOutput) ;
            $inserted = array($value);
            array_splice($this->jobOutput, $position, 0, $inserted);
        } else {
            array_push($this->jobOutput, $value);
            array_push($this->jobOutput, $key);
        }
    }
    private function checkDependencies($keyValueArray)
    {
        foreach ($keyValueArray as $key => $value) {
            if ($key == $value) {
                return true;
            }
        }
    }
}
$test = new Jobs;
$job = "a =>
b => c
c => f
d => a
e => b
f =>";
echo $test->getJobs($job);
