This is my app for construction site that tracks progress on site.
Front end - Vue, backend - Laravel REST API.
The main part is an approval system with

RFI - request for inspection created by Contractor with options Open, Cancel
and RFI is approved by Inspector with options Approve,On hold, Rejected.  
Construction Site is stuctured by Structures and substructures (different for each Part).
Issue module is for open and active topics to be solved with ability to attached documents. 

Drawings and Transmittal form. 
This part keeps record for the lates darwing, history of the drawing, revisions, version, transmittal history.
Tables used: drawing(project_id, part_id...), project, part, 
drawingdet(drawing_id, version, revision...), drawingfile(drawingdet_id...), 
drawingtransmittal  and drawingdet (many to many wiht pivot tabel drawingdet_drawingtransmittal)

Task feature
task,task-pic