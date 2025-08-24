@echo off
setlocal enabledelayedexpansion

rem Loop through all PDB files matching the pattern
for %%f in (AF-*-F1-model_v4.pdb) do (
    rem Extract the unique identifier part from the filename
    set "filename=%%~nf"
    set "uniqueId=!filename:AF-=!"
    set "uniqueId=!uniqueId:-F1-model_v4=!"

    rem Define the new filename
    set "newFilename=!uniqueId!_prep.pdb"

    rem Rename the file
    ren "%%f" "!newFilename!"

    rem Print the rename operation
    echo Renamed: %%f to !newFilename!
)

endlocal
pause
