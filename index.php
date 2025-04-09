<?php
class IPL{
  private $servername = "localhost";
  private $username = "garvita";
  private $password = "1234";
  private $db = "ipldatabase";
  public $con;
   
  public function __construct(){
    $this->con = new mysqli($this->servername,$this->username,$this->password,$this->db);
    if ($this->con->connect_error) {
      die("Connection failed: " . $this->con->connect_error);
    }
    $sql = "CREATE DATABASE IF NOT EXISTS $this->db";
    if ($this->con->query($sql) !== TRUE) {
      echo "Error creating database: " . $this->con->error;
    }
    $this->con->select_db($this->db);
    
  }
  public function venue(){
    $sql = "CREATE TABLE IF NOT EXISTS venue(
    id INT AUTO_INCREMENT PRIMARY KEY,
    venue_name varchar(250) not null
    )";
    if ($this->con->query($sql) !== TRUE) {
      echo "Error creating table : " . $this->con->error;
      return;
    }
  }
   public function insert_venue(){
  
  $venues =[
    ['id' => 1, 'venue_name' => 'Kolkata'],
    ['id' => 2, 'venue_name' => 'Hyderabad'],
    ['id' => 3, 'venue_name' => 'Ahmedabad'],
    ['id' => 4, 'venue_name' => 'Chennai'],
    ['id' => 5, 'venue_name' => 'Guwahati'],
    ['id' => 6, 'venue_name' => 'Lucknow'],
    ['id' => 7, 'venue_name' => 'Bengaluru'],
    ['id' => 8, 'venue_name' => 'Jaipur'],
    ['id' => 9, 'venue_name' => 'Delhi'],
    ['id' => 10, 'venue_name' => 'New Chandigarh'],
    ['id' => 11, 'venue_name' => 'Mumbai'],
    ['id' => 12, 'venue_name' => 'Visakhapatnam'],
    ['id' => 13, 'venue_name' => 'Dharamsala']
  ];
    $sql = "SELECT * FROM venue";
    $result = $this->con->query($sql);
   
    if($result->num_rows == 0){
      foreach ($venues as $venue){
        $insert_sql = "INSERT INTO venue (id, venue_name) VALUES ('" . $venue['id'] . "', '" . $venue['venue_name'] . "')";
        if ($this->con->query($insert_sql) !== TRUE) {
          echo "Error inserting data: " . $this->con->error;
      }
      }

    }

   }
  public function team_table(){
    $sql = "CREATE TABLE IF NOT EXISTS team(
      id INT AUTO_INCREMENT PRIMARY KEY,
      team_name varchar(250) not null,
      captain varchar(200) not null
      )";
    if ($this->con->query($sql) !== TRUE) {
      echo "Error creating table: " . $this->con->error;
      return;
    }
  }
  public function insert_team(){
   
 $teams =[
   ['id' => 1, 'team_name' => 'Chennai Super Kings','captain' => 'Ruturaj Gaikwad'],
   ['id' => 2, 'team_name' => 'Delhi Capitals','captain' => 'Axar Patel'],
   ['id' => 3, 'team_name' => 'Gujarat Titans','captain' => 'Shubhman Gill'],
   ['id' => 4, 'team_name' => 'Kolkata Knight Riders','captain' => 'Ajinkya Rahane'],
   ['id' => 5, 'team_name' => 'Lucknow Super Giants','captain' => 'Rishabh Pant'],
   ['id' => 6, 'team_name' => 'Mumbai Indians','captain' => 'Hardik Pandya'],
   ['id' => 7, 'team_name' => 'Punjab Kings','captain' => 'Shreyas Iyer'],
   ['id' => 8, 'team_name' => 'Rajasthan Royals','captain' => 'Sanju Samson'],
   ['id' => 9, 'team_name' => 'Royal Challengers Bengaluru','captain' => 'Rajat Patidar'],
   ['id' => 10, 'team_name' =>'Sunrises Hyderabad','captain' => 'Pat Cummins']
   
 ];
   $sql = "SELECT * FROM team";
   $result = $this->con->query($sql);
  
   if($result->num_rows == 0){
     foreach ($teams as $team){
       $insert_sql = "INSERT INTO team (id, team_name, captain) VALUES ('" . $team['id'] . "', '" . $team['team_name'] ."','" . $team['captain'] ."')";
       if ($this->con->query($insert_sql) !== TRUE) {
         echo "Error inserting data: " . $this->con->error;
     }
     }

   }

  }
  public function match_table(){
    $sql = "CREATE TABLE IF NOT EXISTS iplmatch(
      id INT AUTO_INCREMENT PRIMARY KEY,
      match_date date NOT NULL,
      venue_id int NOT NULL,
      team1_id int NOT NULL,
      team2_id int NOT NULL,
      toss_won int NOT NULL,
      match_won int NOT NULL,
      FOREIGN KEY(venue_id) REFERENCES venue(id),
      FOREIGN KEY(team1_id) REFERENCES team(id),
      FOREIGN KEY(team2_id) REFERENCES team(id)
      )";
    if ($this->con->query($sql) !== TRUE) {
      echo "Error creating table: " . $this->con->error;
      return;
    }
  }

  public function insert_match(){

 $matches =[
  ['id' => 1,'match_date' => '2025-03-22','venue_id' => 1, 'team1_id' => 4,'team2_id' => 9, 'toss_won' => 9, 'match_won' => 9 ],              
   ['id' => 2,'match_date' => '2025-03-23','venue_id' => 2, 'team1_id' => 10,'team2_id' => 8, 'toss_won' => 8, 'match_won' => 10 ],
   ['id' => 3,'match_date' => '2025-03-23','venue_id' => 4, 'team1_id' => 1, 'team2_id' => 6, 'toss_won' => 1, 'match_won' =>1],
   ['id' => 4,'match_date' => '2025-03-24','venue_id' => 12, 'team1_id' => 2,'team2_id' => 5, 'toss_won' => 2, 'match_won' => 2 ],
   ['id' => 5,'match_date' => '2025-03-25','venue_id' => 3, 'team1_id' => 3,'team2_id' => 7, 'toss_won' => 3, 'match_won' => 7 ],
   ['id' => 6,'match_date' => '2025-03-26','venue_id' => 5, 'team1_id' => 8,'team2_id' => 4, 'toss_won' => 4, 'match_won' => 8 ],
   ['id' => 7,'match_date' => '2025-03-27','venue_id' => 2, 'team1_id' => 10,'team2_id' => 5, 'toss_won' => 5, 'match_won' => 5 ],
   ['id' => 8,'match_date' => '2025-03-28','venue_id' => 4, 'team1_id' => 1,'team2_id' => 9, 'toss_won' => 1, 'match_won' => 9 ],
   ['id' => 9,'match_date' => '2025-03-29','venue_id' => 3, 'team1_id' => 3,'team2_id' => 6, 'toss_won' => 6, 'match_won' => 3 ],
   ['id' => 10,'match_date' => '2025-03-30','venue_id' => 12, 'team1_id' => 2,'team2_id' => 10, 'toss_won' => 10, 'match_won' => 2 ] 
 ];
   $sql = "SELECT * FROM iplmatch";
   $result = $this->con->query($sql);
  
   if($result->num_rows == 0){
     foreach ($matches as $iplmatch){
       $insert_sql = "INSERT INTO iplmatch(id, match_date, venue_id, team1_id, team2_id, toss_won, match_won) VALUES('" . $iplmatch['id'] . "', '" . $iplmatch['match_date'] ."','" . $iplmatch['venue_id'] ."','" . $iplmatch['team1_id'] . "','" . $iplmatch['team2_id'] . "','" . $iplmatch['toss_won'] . "','" . $iplmatch['match_won'] . "')";
       if ($this->con->query($insert_sql) !== TRUE) {
         echo "Error inserting data: " . $this->con->error;
     }
     }

   }

  }
  public function display_result(){
    $sql = "SELECT m.id as match_no,m.match_date,t1.team_name as team1_name,t1.captain as team1_captain,t2.team_name as team2_name,t2.captain as team2_captain,v.venue_name as venue,tw.team_name as toss_won_team , mw.team_name  as match_won_team FROM iplmatch AS m JOIN team as t1 on m.team1_id = t1.id JOIN team as t2 on m.team2_id = t2.id JOIN venue as v on v.id = m.venue_id JOIN team as tw on tw.id = m.toss_won JOIN team as mw on mw.id = m.match_won";
    $result = $this->con->query($sql);
    if ($result->num_rows > 0) {
        echo "<table border =1>";
        echo "<tr>";
        echo "<th>" . "Match Number" . "</th>";
        echo "<th>" . "Match Date" . "</th>";
        echo "<th>" . "Team 1" . "</th>";
        echo "<th>" . "Team 1 Captain" . "</th>";
        echo "<th>" . "Team 2" . "</th>";
        echo "<th>" . "Team 2 Captain" . "</th>";
        echo "<th>" . "Venue" . "</th>";
        echo "<th>" . "Toss Won" . "</th>";
        echo "<th>" . "Match Won" . "</th>";
        echo "</tr>";
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['match_no'] . "</td>";
          echo "<td>" . $row['match_date'] . "</td>";
          echo "<td>" . $row['team1_name'] . "</td>";
          echo "<td>" . $row['team1_captain'] . "</td>";
          echo "<td>" . $row['team2_name'] . "</td>";
          echo "<td>" . $row['team2_captain'] . "</td>";
          echo "<td>" . $row['venue'] . "</td>";
          echo "<td>" . $row['toss_won_team'] . "</td>";
          echo "<td>" . $row['match_won_team'] . "</td>";
          echo "</tr>";
        }
        echo"</table>";
    }
    else {
      echo "No record found";
  } 
}

}
$record = new IPL(); 
$record->venue();
$record->insert_venue();
$record->team_table();
$record->insert_team();
$record->match_table();
$record->insert_match();
$record->display_result();
?>
