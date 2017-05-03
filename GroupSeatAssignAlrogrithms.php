<?php
					
					

function getSeatID($RowNum, $ColNum)
{
	$alphabet = array( 'A', 'B', 'C', 'D', 'E',
                       'F', 'G', 'H', 'I', 'J',
                       'K', 'L', 'M', 'N', 'O',
                       'P', 'Q', 'R');
	$Row_alpha = $alphabet[$RowNum];
	$return_value = "$Row_alpha"."_"."$ColNum";
    return $return_value;		   
}
function RegionGroupAssign($StartCol,$EndCol,$StartRow,$EndRow,&$GroupCount)
{
	
	$GroupsInRegion = array();
		$CurrentCol = $StartCol;
		while($CurrentCol < EndCol) 
		{
			$CurrentRow = $StartRow;
			while($CurrentRow < $EndRow)
			{
				$NextCol = $CurrentCol + 1;
				$NextRow = $CurrentRow + 1;
				$Seat1=getSeatID($CurrentRow,$CurrentCol);
				$Seat2=getSeatID($CurrentRow,$NextCol);
				$Seat3=getSeatID($NextRow,$CurrentCol);
				$Seat4=getSeatID($NextRow,$NextCol);

				$GroupCount += 1;
				$CurrentGroup = array($GroupCount, $Seat1, $Seat2, $Seat3, $Seat4);
				array_push($GroupsInRegion,$CurrentGroup);
				$CurrentRow += 2;
			}
			$CurrentCol += 2;
		}
	return $GroupsInRegion;
}
function AssignAllRegions()
{
	$GroupCount = 0;
	$AllGroups = array();
	$Region1 = RegionGroupAssign(2,3,1,10,$GroupCount);
	$Region2 = RegionGroupAssign(6,19,1,10,$GroupCount);
	$Region3 = RegionGroupAssign(22,23,1,10,$GroupCount);
	$Region4 = RegionGroupAssign(2,3,11,18,$GroupCount);
	$Region5 = RegionGroupAssign(6,19,11,18,$GroupCount);
	$Region6 = RegionGroupAssign(22,23,11,18,$GroupCount);
	array_push($AllGroups($Region1,$Region2,$Region3,$Region4,$Region5,$Region6));
	return $AllGroups;
}
?>